<!DOCTYPE html>
<html lang="en">
@include('head')

<body>



    <!-- Navigation-->
    @include('navbar')
    <!-- Header-->

    <header class="bg-dark py-5" style="background: url('banner_img/background_2.png') ">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center">
                <h1 class="display-4 text-gray-900 font-weight-bolder">Order Your Food Now !</h1>
                <p class="lead mb-0 text-gray-900 font-weight-bold">Literally few clicks away</p>
            </div>
        </div>

    </header>
    <div class="card mt-1 mb-n5" style="width: 100%;">
        <div class="card-header text-center fa-2x text-gray-800">
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

    @include('footer')

</body>

</html>
