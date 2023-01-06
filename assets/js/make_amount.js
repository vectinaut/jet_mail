$(function (){
    $('.cart-list__item-btn').on('click', function () {
        let id = parseInt($(this)[0].value);
        let amount = parseInt($(this)[0].innerHTML);

        // console.log([id, amount]);

        $.ajax({
            url: "make_amount.php",
            type: 'GET',
            data: {cart: 'make_amount', id: id, amount: amount},
            dataType: 'json',
            success: function (res) {
                if (res.code !== 'ok'){
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error');
            }
        });

    });
});