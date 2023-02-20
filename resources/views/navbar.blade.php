<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/dashboard"><img class="logo_img sticky_logo"
                src="https://digitalsymphony.it/logo/ds-white.png" style="width: 40px; height: 45px;" alt="white logo">
            Jom Order</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                {{-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li> --}}
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
            </ul>
            <div>
            </div>
            <form>
                <button class="ml-3 btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Your Order
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
            <hr>
            <form class="d-flex" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger" type="submit">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </div>
</nav>