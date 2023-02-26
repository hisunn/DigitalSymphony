<!DOCTYPE html>
<html lang="en">
@include('head')

<body class="d-flex flex-column min-vh-100">
    @include('navbar')

    <h1 class="text-xl-center mt-5 mb-5 text-gray-900">Order History</h1>
    <div class="container-sm">
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
                    <p>Order Id: {{  substr(md5($timestamp),0,8) }}</p>
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
