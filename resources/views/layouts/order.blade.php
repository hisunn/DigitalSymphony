<!DOCTYPE html>
<html lang="en">
@include('head')

<body onload="isEmpty({{ $_GET['quantity'] }})" class="d-flex flex-column min-vh-100">

    @include('navbar')

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Are You Sure ?</h5>
                    <button class="btn btn-close" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div id="modalDesc" class="modal-body">
                    You will delete this order
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="modalBtn" href="deleteOrder" type="button" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>


    <h1 id="notemptymsg1" class="text-center text-gray-900 mt-4">Your Order</h1>
    <div class="container-sm mt-3 mb-3">

        <div>
            <h1 id="emptymsg1" class="text-xl-center text-gray-900 mt-5">It Seems Empty Over Here...</h1>
            <div class="d-flex justify-content-center mt-5">
                <a id="emptymsg2" class="btn btn-primary text-center rounded-sm" href="dashboard">Order Now !</a>
            </div>
        </div>
        @php
            $oldtotal = 0;
        @endphp
        @foreach ($sql as $display)
            <div class="card mb-3">
                @php
                    if (isset($display->deleted_at)) {
                        continue;
                    }
                    
                    $old_total = 0;
                    $total = 0;
                    $total += $display->item_quantity * $display->item_price;
                    $oldtotal += $display->item_quantity * $display->item_price;
                @endphp
                <input hidden id="price_{{ $display->item_id }}" type="text" value="{{ $total }}">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="menu_img/{{ $display->item_image }}" class="img-thumbnail rounded-start"
                            alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $display->item_name }}</h5>
                            <p value class="card-text">Quantity: <input id="quantity-{{ $display->item_id }}"
                                    type="text" class="w-auto bg-transparent border-0 text-gray-700" disabled
                                    value="{{ $display->item_quantity }}"> </p>
                            <p class="card-text">Price: RM {{ $display->item_price }}</p>
                            {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                            {{-- make ajax request here --}}
                            <button id="{{ $display->item_id }}"
                                onclick="updateQuantity('minus',{{ $display->item_id }},{{ $display->item_price }})"
                                class="btn btn-primary">-</button>&nbsp;<button id="{{ $display->item_id }}"
                                onclick="updateQuantity('plus',{{ $display->item_id }},{{ $display->item_price }})"
                                class="btn btn-primary">+</button>
                            <button onclick="passToModal({{ $display->item_id }})" value="{{ $display->item_id }}"
                                class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Modal">Discard
                                Item
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <form id="notemptymsg2" action="payment-gateway" method="post">
            @csrf
            <div class="card mb-3 ">
                <div class="card-body text-center" style="max-width: 1000px;">
                    <span class="text-center">Total Price : RM <input id="totalprice"
                            class="w-auto bg-transparent border-0 text-gray-700" disabled type="text"
                            value="{{ $oldtotal }}"> </span>
                    {{-- <button onclick="confirmModal('restoreBtn')" data-bs-toggle="modal" data-bs-target="#Modal"
                        type="button" title="Restore Order" class="btn btn-info">Restore Order <i
                            class="bi bi-arrow-clockwise"></i></button> --}}

                </div>
            </div>
            <input hidden type="text" name="url" value="{{ url('/') }}">
            {{-- <button class="btn btn-block btn-outline-secondary">Cancel</button> --}}
            <button type="button" onclick="confirmModal('checkoutBtn')" data-bs-toggle="modal" data-bs-target="#Modal"
                class="btn btn-block btn-success">Check Out</button>
        </form>
    </div>
    @include('footer')
</body>

<script>
    function updateQuantity(buttonType, id, price) {
        // Get the current quantity for this item
        var currentQuantity = parseInt($("#quantity-" + id).val());
        // Update the quantity based on the button that was clicked
        if (buttonType === "plus") {
            currentQuantity++;
            $("#price_" + id).val(currentQuantity * price);

            let accumulator = 0;
            for (let i = 1; i < 5; i++) {

                let NaNCheck = parseInt($("#price_" + i).val());
                if (isNaN(NaNCheck)) {
                    accumulator += 0;
                } else {
                    accumulator += parseInt($("#price_" + i).val());
                }
            }
            $("#totalprice").val(accumulator);
        } else if (buttonType === "minus" && currentQuantity > 1) {
            currentQuantity--;
            $("#price_" + id).val(currentQuantity * price);
            let accumulator = 0;
            for (let i = 1; i < 5; i++) {
                let NaNCheck = parseInt($("#price_" + i).val());
                if (isNaN(NaNCheck)) {
                    accumulator -= 0;
                } else {
                    accumulator -= parseInt($("#price_" + i).val());
                }
            }
            $("#totalprice").val(Math.abs(accumulator));
        }

        // Update the input field for this item with the new quantity
        $("#quantity-" + id).val(currentQuantity);
    }

    function isEmpty(quantity) {
        // console.log(quantity);
        if (quantity) {
            $('#emptymsg1').hide();
            $('#emptymsg2').hide();
        } else {
            $('#emptymsg1').show();
            $('#emptymsg2').show();
            $('#notemptymsg1').attr('hidden', true);
            $('#notemptymsg2').attr('hidden', true);
            $('#notemptymsg3').attr('hidden', true);
        }
    }

    function passToModal(id) {
        $(".modal-title").html("Are You Sure ?");
        $("#modalDesc").html("You will delete this item permanently");
        $("#modalBtn").html("Delete");
        $('#modalBtn').attr('class', 'btn btn-danger');
        let btn_id = id;
        $("#modalBtn").attr('href', 'deleteItem?item_id=' + id)
        console.log(btn_id);
    }

    function confirmModal(buttonType) {

        // console.log(buttonType);
        if (buttonType == 'checkoutBtn') {
            console.log("inside checkout");

            for (let i = 1; i < 5; i++) {
                let new_quantity = parseInt($("#quantity-" + i).val());
                if (new_quantity) {
                    localStorage.setItem(i, new_quantity);
                }
            }

            $(".modal-title").html();
            $("#modalDesc").html("Proceed To Checkout");
            $("#modalBtn").html("Proceed Checkout");
            $('#modalBtn').attr('class', 'btn btn-primary');
            $('#modalBtn').attr('href', 'updateOrder');



            let key1 = JSON.parse(localStorage.getItem(1));
            let key2 = JSON.parse(localStorage.getItem(2));
            let key3 = JSON.parse(localStorage.getItem(3));
            let key4 = JSON.parse(localStorage.getItem(4));

            let url = $('input[name="url"]').val();
            $.ajax({
                url: url + "/updateOrder",
                type: 'GET',
                data: {
                    key1: key1,
                    key2: key2,
                    key3: key3,
                    key4: key4,
                },
                success: function(response) {
                    console.log("Eyyo");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + ': ' + errorThrown);
                }
            });



        }

        if (buttonType == 'restoreBtn') {
            console.log("inside restore");

            $(".modal-title").html('Restore ?');
            $("#modalDesc").html("This will restore your order");
            $("#modalBtn").html("Proceed Restore");
            $('#modalBtn').attr('class', 'btn btn-primary');
            $('#modalBtn').attr('href', 'restoreOrder');
        }




    }
</script>

</html>
