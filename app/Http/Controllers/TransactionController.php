<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TransactionService;

class TransactionController extends Controller
{
    public function index(){

       list($allTransactions, $currentBalance) = $this->usersCurrentBalance();
       return view('dashboard', compact('allTransactions', 'currentBalance'));
    }
    public function usersCurrentBalance(){
       $userWithTransactions = User::query()->with(['transactions'])->where('id', Auth::id())->first();
       $allTransactions = $userWithTransactions->transactions ?? [];
       $depositAmount   = collect($allTransactions)->where('transaction_type', 'deposit')->sum('amount') ?? 0;
       $withdrawlAmount = collect($allTransactions)->where('transaction_type', 'withdrawal')->sum('amount') ?? 0;
       $fee = collect($allTransactions)->sum('fee') ?? 0;
       $balance = $depositAmount - $withdrawlAmount - $fee;
       return array($allTransactions, $balance);
    }
    public function depositIndex(){
        $depositTransactions = Transaction::query()->where('user_id', Auth::id())->where('transaction_type', 'deposit')->get();
        return view('depositIndex', compact('depositTransactions'));
    }
    public function depositStore(Request $request){
        $request->validate([
            'amount' => ['required'],
        ]);

        $deposit = Transaction::create([
            'user_id' => Auth::id(),
            'transaction_type' => 'deposit',
            'amount' => $request->amount,
            'fee' => 0,
            'date' => Carbon::now()
        ]);
        return redirect()->route('deposit.index');
    }

    public function withdrawalIndex(){
        $withdrawalTransactions = Transaction::query()->where('user_id', Auth::id())->where('transaction_type', 'withdrawal')->get();
        return view('withdrawalIndex', compact('withdrawalTransactions'));
    }
    public function withdrawaAmount(Request $request){
        $request->validate([
            'amount' => ['required'],
        ]);
        $amount = $request->amount;

        list(, $balance)  = $this->usersCurrentBalance();

        $user = User::find(Auth::id());
        $accountType = $user->account_type;
        $date = Carbon::now();

        $totalWithdrawnThisMonth = Transaction::where('user_id', Auth::id())
            ->where('created_at', '>=', $date->startOfMonth())
            ->where('transaction_type', 'withdrawal')
            ->sum('amount');

        $withdrawalFee = 0;

        if ($accountType == 'Individual') {
            $withdrawalRate = 0.015;
            if ($date->format('l') == 'Friday') {
                $withdrawalFee = 0;
            } elseif ($amount <= 1000) {
                $withdrawalFee = 0;
            } elseif ($totalWithdrawnThisMonth < 5000) {
                $withdrawalFee = 0;
            } else {
                $withdrawalFee = $amount * $withdrawalRate;
            }
        } elseif ($accountType == 'Business') {
            $withdrawalRate = 0.025;
            if ($totalWithdrawnThisMonth >= 50000) {
                $withdrawalRate = 0.015;
            }
            $withdrawalFee = $amount * $withdrawalRate;
        }

        if (($amount + $withdrawalFee) > $balance) {
           return redirect()->route('withdrawal.index');
        }

        $withdrawal =  Transaction::create([
            'user_id' => Auth::id(),
            'transaction_type' => 'withdrawal',
            'amount' => $amount,
            'fee' => $withdrawalFee,
            'date' => Carbon::now()
        ]);

        return redirect()->route('withdrawal.index');


    }

}
