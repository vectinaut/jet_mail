document.addEventListener("DOMContentLoaded", () => {

  const paymentBtns = document.querySelectorAll('.payment-btns__btn');
  const paymentMainBtn = document.querySelector('.payment__main-btn');
  const totalPrice = document.querySelector('.payment__total-price');
  const cartItems = document.querySelectorAll('.cart-list__item');
  let cartItemsPrice = [];
  let summ = 0;

  for (let i = 0; i < cartItems.length; i++){
    cartItemsPrice.push(parseInt(cartItems[i].querySelector('.cart-list__item-price').innerHTML))
    let mounthBtn = cartItems[i].querySelector('.cart-list__item-btn-active');
    cartItems[i].querySelector('.cart-list__item-price').innerHTML = countPrice(mounthBtn, cartItemsPrice[i])+'р.';
    summ = summ + parseInt(countPrice(mounthBtn, cartItemsPrice[i]));
  };
  // console.log(cartItemsPrice);

  totalPrice.innerHTML = 'Итого: '+`${summ}`+'р.'

  for (let i = 0; i < cartItems.length; i++){

    const cartBtns = cartItems[i].querySelectorAll('.cart-list__item-btn');

    cartBtns.forEach((cartBtn) =>{
      cartBtn.addEventListener('click', (event) =>{
        const currentPrice = parseInt(cartItems[i].querySelector('.cart-list__item-price').innerHTML);
        for(let j in cartBtns){
          if(event.currentTarget === cartBtns[j]){
            cartBtns[j].classList.add('cart-list__item-btn-active');
            cartItems[i].querySelector('.cart-list__item-price').innerHTML = countPrice(cartBtns[j], cartItemsPrice[i])+'р.';
            totalPrice.innerHTML = 'Итого: '+`${parseInt(totalPrice.innerHTML.trim().split(' ')[1])- currentPrice + parseInt(countPrice(cartBtns[j], cartItemsPrice[i]))}`+'р.';
          } else if(cartBtns[j].classList.contains('cart-list__item-btn-active')){
            cartBtns[j].classList.remove('cart-list__item-btn-active');
          };
        };
      });
    });

    cartItems[i].querySelector('.cart-list__item-close-btn').addEventListener('click', ()=>{
      cartItems[i].remove();
      const currentPrice = parseInt(cartItems[i].querySelector('.cart-list__item-price').innerHTML);
      totalPrice.innerHTML = 'Итого: '+`${parseInt(totalPrice.innerHTML.trim().split(' ')[1])- currentPrice}`+'р.'
    })
  };


  paymentBtns[0].addEventListener('click', () =>{
    paymentBtns[0].classList.add('payment-btns__btn-active');
    paymentBtns[1].classList.remove('payment-btns__btn-active');
    paymentMainBtn.innerHTML = 'Оплатить';
  });
  paymentBtns[1].addEventListener('click', () =>{
    paymentBtns[1].classList.add('payment-btns__btn-active');
    paymentBtns[0].classList.remove('payment-btns__btn-active');
    paymentMainBtn.innerHTML = 'Заказать';
  });

  // paymentMainBtn.addEventListener('click', (event) =>{
  //   if(paymentMainBtn.innerHTML === 'Заказать'){
  //     event.preventDefault();
  //     alert( "Товары заказаны" );
  //   };
  // });

  function countPrice(el, price){
    const month = parseInt(el.innerHTML);
    return(`${month*price}`);
  };
});

