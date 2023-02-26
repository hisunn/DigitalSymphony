<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/dashboard"><img class="logo_img sticky_logo"
                src="https://digitalsymphony.it/logo/ds-white.png" style="width: 40px; height: 45px;" alt="white logo">
            <span style="font-family: 'Concert One', cursive;">Jom Order</span> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" href="/setting">Setting</a></li>
                <li class="nav-item mr-3"><a class="nav-link" aria-current="page" href="order-history">Order History</a>
                </li>
            </ul>
            <div>
            </div>
            <form action="/order-list" method="GET">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi bi-bag-fill"></i>
                    Your Order
                    @php
                        use Illuminate\Support\Facades\DB;
                        $sql = DB::select('SELECT SUM(quantity) as quantity from orders where user_id=' . auth()->user()->id);
                        foreach ($sql as $display) {
                        }
                        if ($display->quantity == null || $display->quantity == '') {
                            $display->quantity = 0;
                        }
                    @endphp
                    <input type="text" name="quantity" hidden value="{{ $display->quantity }}">
                    <span id="display_quantity" class="badge bg-primary text-white ms-1 rounded-pill">
                        {{ $display->quantity }}</span>
                </button>
            </form>
            <hr>
            <span class="mr-2">Hi <span class="font-weight-bold text-gray-800"> {{ auth()->user()->name }}</span> !</span>
            <form class="d-flex" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger" type="submit">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </div>
</nav>
