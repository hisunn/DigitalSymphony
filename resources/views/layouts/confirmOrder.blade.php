<!DOCTYPE html>
<html lang="en">
@include('head')
@foreach ($total_quantity as $view)

    <body onload="checkQuantity({{ $view->quantity }})" class="d-flex flex-column min-vh-100">
        @include('navbar')
@endforeach

@yield('list')
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="ModalLabel"></h5>
                <button class="btn btn-close" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close">X</button>
            </div>
            <div id="modalDesc" class="modal-body text-gray-800"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="modalBtn" href="deleteOrder" type="button" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
</body>

@include('footer')



</html>

<script>
    function buttonType(buttonType) {
        console.log("inside");

        // console.log(buttonType);

        if (buttonType == 'delete') {

            $(".modal-title").html("Delete current order ?");
            $("#modalDesc").html("You are deleting this order");
            $("#modalBtn").html("Delete");
            $('#modalBtn').attr('class', 'btn btn-danger');
            $('#modalBtn').attr('href', 'deleteOrder');

        } else {
            $(".modal-title").html("Restore the order ?");
            $("#modalDesc").html("You are restoring this order");
            $("#modalBtn").html("Restore");
            $('#modalBtn').attr('class', 'btn btn-info');
            $('#modalBtn').attr('href', 'restoreOrder');
        }


    }

    function checkQuantity(quantity) {

        if (quantity == 0) {
            $('#deleteBtn').attr('disabled', true);
            $('#restoreBtn').attr('disabled', false);
            $('#order-list').attr('hidden', true);
            $('#order-instruction').attr('hidden', false);
            $('#proceedBtn').attr('href', '#error');
            $('#proceedBtn').attr('class', 'btn btn-block btn-warning');
            $('#price').attr('hidden', true);



            console.log('quantity is 0');
        } else {
            console.log('quantity is not 0');
            $('#deleteBtn').attr('disabled', false);
            $('#restoreBtn').attr('disabled', true);
            $('#order-list').attr('hidden', false);
            $('#order-instruction').attr('hidden', true);
            $('#proceedBtn').attr('href', 'paidOrder');
            $('#price').attr('hidden', false);



        }
    }
</script>
