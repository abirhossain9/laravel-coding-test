<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Mediusware</title>
  </head>
<body style="padding: 2%; border: 2px solid black; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); margin: 4%;">
    @include('layouts.nav')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <table class="table" style="text-align: center">
                    <thead>
                        <tr>
                        <th>current balance.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td scope="row">{{ $currentBalance }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
            <h2>All Transactions</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Fee</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                     @if (count($allTransactions) > 0)
                    <tbody>
                        @foreach ($allTransactions as $transaction)
                            <tr>
                                <td>{{ ucfirst($transaction->transaction_type) }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->fee }}</td>
                                <td>{{ $transaction->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    @else
                    <tbody>
                        <td colspan="4" style="text-align: center">No Data Found</td>
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
