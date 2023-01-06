$(function (){
    $('.cart-list__item-close-btn').on('click', function (e) {
        e.preventDefault();
        let id = $(this)[0].value;

        $.ajax({
            url: "delete_from_cart.php",
            type: 'GET',
            data: {cart: 'delete', id: id},
            dataType: 'json'
        });
    });
});