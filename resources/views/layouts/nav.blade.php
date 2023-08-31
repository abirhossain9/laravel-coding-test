 <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="/deposit">Deposit</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="/withdrawal">Withdrawal</a>
                    </li>
                </ul>
                <form class="d-flex" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-success" type="submit">Log Out</button>
                </form>
                </div>
            </div>
</nav>
