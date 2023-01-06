$(function (){
    $('.payment__main-btn').on('click', function (e) {
        e.preventDefault();

        const qty = document.querySelectorAll('.cart-list__item-btn-active');
        console.log(qty);
        for (let mon in qty){
            let qt = parseInt(qty[mon].innerHTML);
            console.log(qt);
        }

        // let type_order = $(this)[0].querySelectorAll(".cart-list__item-btn-active");
        // for (mon in type_order){
        //     console.log(type_order[mon]);
        // }
        // console.log(type_order);


    });
});