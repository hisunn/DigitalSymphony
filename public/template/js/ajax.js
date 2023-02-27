function addOrder() {

    $(document).ready(function () {

        let price = $('input[name="price"]').val();
        let foodname = $('input[name="foodname"]').val();
        let amount = $('input[name="amount"]').val();
        let foodtype = $('button[name="foodtype"]').val();
        let url = $('input[name="url"]').val();

        $.ajax({
            url: url + "/insertOrder",
            type: 'GET',
            data: {
                price: price,
                foodname: foodname,
                amount: amount,
                foodtype: foodtype,
            },
            success: function (response) {
                let change_content_navbar = $("#display_quantity").html(response);
                let change_value_order = $('input[name="quantity"').attr('value',response);              
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });

    });
}




