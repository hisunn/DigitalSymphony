<!DOCTYPE html>
<html lang="en">
@include('head')
@foreach ($sql2 as $checkhistory)
@endforeach

<body onload="checkHistory({{ $checkhistory->history_count }})" class="d-flex flex-column min-vh-100">
    @include('navbar')

    <h1 id="title" class="text-xl-center mt-5 mb-5 text-gray-900">Order History</h1>
    <div class="container-sm">
        <div id="emptytitle">
            <h1 id="emptymsg1" class="text-xl-center text-gray-900 mt-5">It Seems Empty Over Here...</h1>
            <div class="d-flex justify-content-center mt-5">
                <a id="emptymsg2" class="btn btn-primary text-center rounded-sm" href="dashboard">Order Now !</a>
            </div>
        </div>


        <ul class="list-group mb-5">

            @php
                use Illuminate\Support\Facades\DB;
            @endphp
            @foreach ($sql as $data)
                @php
                    $timestamp = $data->paid_at;
                    
                    $query = DB::select('SELECT user_id, item_id, item_name, item_price, quantity, paid_at FROM orders_history WHERE paid_at="' . $timestamp . '"');
                    
                @endphp
                <li class="list-group-item">
                    <p>Order Id: {{ substr(md5($timestamp), 0, 8) }}</p>
                    @foreach ($query as $display)
                        <p>{{ $display->item_name }} <b>X</b> {{ $display->quantity }}</p>
                    @endforeach
                    <p>Paid on: {{ $display->paid_at }}</p>
                </li>
            @endforeach

        </ul>
    </div>


</body>
@include('footer')

</html>

<script>
    function checkHistory(history_count) {
        if (history_count == 0) {
            $("#title").attr('hidden', true);
        } else {
            $("#title").attr('hidden', false);
            $("#emptytitle").attr('hidden', true);
        }
    }
</script>
