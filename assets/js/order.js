$(function (){
    $('.payment__main-btn').on('click', function (e) {
        e.preventDefault();
        let type = $(this)[0].innerHTML;
        // console.log(type);
        if (type === "Заказать"){
            // console.log(type);
            $.ajax({
                url: "add_order.php",
                type: 'GET',
                data: {cart: 'add_order', type: 'cash' },
                dataType: 'json',
                success: function (res) {
                    if (res.code === 'error'){
                        alert(res.answer);
                    }else if (res.code === 'reload'){
                        alert(res.answer);
                        window.location.href = 'http://localhost/jet_mail/cart.php';
                    }else if(res.code === 'success'){
                        alert(res.answer);
                        window.location.href = 'http://localhost/jet_mail/personal.php';
                    }
                }
            });
        }

    });
});