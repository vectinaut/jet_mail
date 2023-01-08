<?php
include ("app/controllers/users.php");
error_reporting(0);
if (!isset($_COOKIE['user_id']) || $_SESSION['admin']){
  echo "<h1>403 Error</h1>";
  exit();
}
$duration = [1, 3, 6];
if (!isset($_SESSION['cart'])){
  $_SESSION['cart'] = selectAllCarts(['cart.status'=>1, 'user_id'=>$_COOKIE['user_id']], $less=True);
}
$cart_items = selectAllCarts(['cart.status'=>1, 'user_id'=>$_COOKIE['user_id']], $less=True);
$before_cart_ids = array();
$cart_ids = array();

foreach ($_SESSION['cart'] as $key => $value){
  $before_cart_ids[] = $value['pub_id'];
}

foreach ($cart_items as $key => $value){
  $cart_ids[] = $value['pub_id'];
}

$diff_items = array_diff($before_cart_ids, $cart_ids);
if (!empty($diff_items)){
  echo "<script>alert('Некоторые товары закончились');</script>";
  for($i=0; $i<count($diff_items); $i++){
    if ($diff_items[$i]){
      updateCart($_COOKIE['user_id'], $diff_items[$i], ['status'=>0]);
    }
  }
}
$_SESSION['cart'] = $cart_items;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>JET MAIL</title>
  <script defer src="assets/js/cart.js"></script>
</head>
<body>
<?php include("app/include/header.php");?>
<div class="header-bottom-container">
  <div class="container">
    <a href="index.php" class="header__link flex">
          <span class="header__link-icon">
            <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.3417 8.91208C14.966 9.29821 14.3477 9.30437 13.9644 8.92579L8.14183 3.17475C8.06342 3.0973 7.93715 3.09788 7.85945 3.17603L2.15281 8.91591C1.76725 9.30371 1.14293 9.3137 0.745162 8.93845C0.335488 8.55196 0.321627 7.90488 0.714373 7.5012L7.28326 0.749487C7.67588 0.345934 8.32412 0.345934 8.71674 0.749487L15.3417 7.55884C15.7082 7.93549 15.7082 8.53542 15.3417 8.91208Z" fill="#A0A0A4"/>
            </svg>
          </span>
      <span class="header__link-text"> Продолжить покупки </span>
    </a>
  </div>
</div>
<main class="main">
  <section class="cart">
    <div class="container cart-container">
      <?php if ($cart_items): ?>
        <h2 class="cart__title">

          Корзина подписных изданий
        </h2>
        <ul class="cart-list list-resert flex">
          <?php foreach ($cart_items as $key => $value): ?>
            <li class="cart-list__item flex">
              <div class="cart-list__item-photo">
                <a href="<?= "product.php?post=".$value['pub_id'];?>">
                  <img src="assets/img/posts/<?php echo $value['img']?>" alt="">
                </a>

              </div>
              <div class="cart-list__item-content flex">
                <div class="cart-list__item-header flex">
                  <h3 class="cart-list__item-title">
                    <a href="<?= "product.php?post=".$value['pub_id'];?>">
                      <?php echo $value['pub_name']; ?>
                    </a>
                  </h3>
                  <form action="cart.php" type="post" class="cart-list__item-close-btn btn-resert">
                    <button value="<?php echo $value['pub_id']; ?>" name="delete-item" class="cart-list__item-close-btn btn-resert" type="reset">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.929612 13.6568C0.539088 14.0473 0.539088 14.6805 0.929612 15.071C1.32014 15.4615 1.9533 15.4615 2.34383 15.071L8.00085 9.41399L13.658 15.0711C14.0485 15.4616 14.6817 15.4616 15.0722 15.0711C15.4627 14.6806 15.4627 14.0474 15.0722 13.6569L9.41506 7.99978L15.0717 2.34309C15.4623 1.95257 15.4623 1.3194 15.0717 0.928879C14.6812 0.538355 14.0481 0.538355 13.6575 0.928879L8.00085 6.58557L2.34427 0.928985C1.95374 0.538461 1.32058 0.538461 0.930055 0.928985C0.539531 1.31951 0.539531 1.95267 0.930055 2.3432L6.58663 7.99978L0.929612 13.6568Z" fill="#A0A0A4"/>
                      </svg>
                    </button>
                  </form>

                </div>
                <span class="cart-list__item-descr">
                Оформить подписку на:
              </span>
                <div class="cart-list__item-btns flex">
                  <?php for($i=0; $i < 3; $i++):?>
                  <?php if($value['quantity'] == $duration[$i]): ?>
                  <button value="<?php echo $value['pub_id']; ?>" class="cart-list__item-btn btn-resert cart-list__item-btn-active">
                    <?php echo $duration[$i]; ?> мес.
                  </button>
                  <?php else: ?>
                  <button value="<?php echo $value['pub_id']; ?>" class="cart-list__item-btn btn-resert">
                    <?php echo $duration[$i]; ?> мес.
                  </button>
                  <?php endif; ?>
                  <?php endfor; ?>
                </div>
                <span class="cart-list__item-price">
                <?php echo $value['price']?>р.
              </span>
              </div>
            </li>
          <?php endforeach;?>

        </ul>
      <?php else: ?>
        <h2 class="cart__title">
          Здесь пока пусто
        </h2>
      <?php endif; ?>
    </div>
  </section>
  <?php if ($cart_items): ?>
    <section class="payment">
      <div class="container payment-container">
        <h2 class="payment__title">
          Выберите способ оплаты
        </h2>
        <div class="payment-btns flex">
          <div class="payment-btns__block flex">
            <button class="payment-btns__btn payment-btns__btn1 btn-resert payment-btns__btn-active">
            </button>
            <span class="payment-btns__descr">
              Банковская карта
            </span>
          </div>
          <div class="payment-btns__block flex">
            <button class="payment-btns__btn payment-btns__btn2 btn-resert">
            </button>
            <span class="payment-btns__descr">
              Наличные
            </span>
          </div>
        </div>
        <div class="payment-block flex">
          <a href="payment.php" class="payment__main-btn">
            Оплатить
          </a>
          <span class="payment__total-price">
            Итого: 1390р.
          </span>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="assets/js/delete_from_cart.js"></script>
<script src="assets/js/make_amount.js"></script>
<script src="assets/js/order.js"></script>
<?php include ("app/include/footer.php")?>
</body>
</html>