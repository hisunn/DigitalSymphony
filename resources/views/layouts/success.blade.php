<!DOCTYPE html>
<html lang="en">
@include('head')

<body onload="redirect('{{ url('/') }}')" class="d-flex flex-column min-vh-100">
    @include('navbar')
    <h1 class="text-center mt-5 mb-5 text-gray-800">Payment Successfull</h1>
    <div class="d-flex justify-content-center mb-5">
        <img class="w-25" src="https://www.svgrepo.com/show/422280/correct-success-tick.svg" alt="">

    </div>
</body>
@include('footer')

</html>

<script>
    function redirect(url) {
        let interval = setInterval(myURL(url), 3000);
    }
    function myURL(url) {
        document.location.href = url+'/dashboard';
        clearInterval(interval);
    }
</script>
