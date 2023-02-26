@extends('layouts.confirmOrder')


@section('list')
    @php
        $total_price = 0;
    @endphp
    <h1 class="text-xl-center mt-5 mb-5 text-gray-900">Confirm Your Order</h1>
    <div class="container-sm">

        <ul id="order-instruction" class="list-group mb-2">
            <li class="list-group-item">To proceed you can either: <ol>
                    <li>Restore Order and proceed to pay</li>
                    <li>Restore Order and discard item at your order screen</li>
                </ol>
            </li>
        </ul>
        <ul id="order-list" class="list-group">
            @foreach ($sql as $display)
                <li class="list-group-item"><img style="width: 100px; height: 80px" src="menu_img/{{ $display->item_image }}"
                        alt=""> {{ $display->item_name }} <i class="bi bi-x">{{ $display->item_quantity }}</i>
                </li>
                @php
                    $total_price += $display->item_price * $display->item_quantity;
                @endphp
            @endforeach

        </ul>
        <ul class="list-group">

            <li class="list-group-item">
                <div class="d-flex justify-content-center">
                    <input type="text" hidden name="url" value="{{ url('/') }}">
                    <button value="delete" id="deleteBtn" onclick="buttonType($('#deleteBtn').val())" data-bs-toggle="modal"
                        data-bs-target="#Modal" class="btn btn-danger w-50">Discard Order</button> &nbsp;
                    <button disabled value="restore" id="restoreBtn" onclick="buttonType($('#restoreBtn').val())"
                        data-bs-toggle="modal" data-bs-target="#Modal" class="btn btn-info w-50">Restore Order</button>
                </div>
            </li>
            <li class="list-group-item">
                <p id="price" class="text-center">Total Price: RM {{ $total_price }}</p>
                <div class="d-flex justify-content-center"><a id="proceedBtn" href="paidOrder"
                        class="btn btn-block btn-success">Proceed To
                        Pay</a></div>
            </li>
        </ul>
    </div>
@endsection
