<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    <!-- Navigation-->
    @include('navbar')
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Order Your Food Now !</h1>
                <p class="lead fw-normal text-white-50 mb-0">Literally few clicks away</p>
            </div>
        </div>

    </header>
    <div class="card mt-1 mb-n5" style="width: 100%;">
        <div class="card-header text-center fa-2x">
            Today's Menu !
        </div>
    </div>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @include('menuCard')
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Ihsan Dzahri 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
