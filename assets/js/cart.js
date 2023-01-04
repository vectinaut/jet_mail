document.addEventListener("DOMContentLoaded", () => {

  const paymentBtns = document.querySelectorAll('.payment-btns__btn');
  const paymentMainBtn = document.querySelector('.payment__main-btn');
  const totalPrice = document.querySelector('.payment__total-price');
  const cartItems = document.querySelectorAll('.cart-list__item');
  let summ = 0;

  for (let i = 0; i < cartItems.length; i++){
    let price = parseInt(cartItems[i].querySelector('.cart-list__item-price').innerHTML);
    summ = summ + price;
  };

  totalPrice.innerHTML = 'Итого: '+`${summ}`+'р.'



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




  cartItems.forEach((cartItem)=>{
    const cartBtns = cartItem.querySelectorAll('.cart-list__item-btn');
    const price = parseInt(cartItem.querySelector('.cart-list__item-price').innerHTML);

    cartBtns.forEach((cartBtn) =>{
      cartBtn.addEventListener('click', (event) =>{
        const currentPrice = parseInt(cartItem.querySelector('.cart-list__item-price').innerHTML);
        for(let i in cartBtns){
          if(event.currentTarget === cartBtns[i]){
            cartBtns[i].classList.add('cart-list__item-btn-active');
            cartItem.querySelector('.cart-list__item-price').innerHTML = countPrice(cartBtns[i], price)+'р.';
            totalPrice.innerHTML = 'Итого: '+`${parseInt(totalPrice.innerHTML.trim().split(' ')[1])- currentPrice + parseInt(countPrice(cartBtns[i], price))}`+'р.';
          } else{
            cartBtns[i].classList.remove('cart-list__item-btn-active');
          };
        };
      });
    });

    cartItem.querySelector('.cart-list__item-close-btn').addEventListener('click', ()=>{
      cartItem.remove();
      const currentPrice = parseInt(cartItem.querySelector('.cart-list__item-price').innerHTML);
      totalPrice.innerHTML = 'Итого: '+`${parseInt(totalPrice.innerHTML.trim().split(' ')[1])- currentPrice}`+'р.'
    })

  });

  paymentMainBtn.addEventListener('click', (event) =>{
    if(paymentMainBtn.innerHTML === 'Заказать'){
      event.preventDefault();
      alert( "Товары заказаны" );
    };
  });

  function countPrice(el, price){
    const month = parseInt(el.innerHTML);
    return(`${month*price}`);
  };
});

