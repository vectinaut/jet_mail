$(function (){
    $('.btn-resert').on('click', function (e) {
        e.preventDefault();
        let id = $(this)[0].value;

        $.ajax({
            url: "add_to_cart.php",
            type: 'GET',
            data: {cart: 'add', id: id},
            dataType: 'json',
            success: function (res) {
                if (res.code === 'ok'){
                    alert(res.answer);
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error');
            }
        });
    });
});