<?php
include ("app/controllers/users.php");

if (isset($_GET['cart'])) {
  switch ($_GET['cart']) {
    case 'make_amount':
//      $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
      if (isset($_GET['id']) && isset($_GET['amount']) ){
        $id = (int)$_GET['id'];
        $amount = (int)$_GET['amount'];

        // Проверка длительности
        if ($amount === 1 || $amount == 3 || $amount === 6){

          $pub = selectOnePublication(['publication_id'=>$id]);
          // Проверка наличия такого товара в БД
          if (!empty($pub) && $pub['amount']>0){

            $carts = selectAll('cart',
              ['user_id'=>$_COOKIE['user_id'],
                'publication_id'=>$id,
                'status'=>1]);

            // Есть такой товар в корзине
            if(!empty($carts)){
              $params = [
                'user_id' => $_COOKIE['user_id'],
                'publication_id' => $id,
                'status' => 1
              ];
              updateCart($_COOKIE['user_id'], $id, ['quantity'=>$amount]);
              $_SESSION['cart'] = selectAllCarts(['cart.status'=>1, 'user_id'=>$_COOKIE['user_id']], $less=True);
//              echo json_encode(['code'=>'ok', 'answer'=>'Товар удален из корзины']);

            }else{
              echo json_encode(['code'=>'ok', 'answer'=>'Такого товара нет в корзине']);
            }
            echo json_encode(['code'=>'ok', 'answer'=>'Такой товар есть в БД']);
          }else{
            echo json_encode(['code'=>'error', 'answer'=>'Такого товара нет в БД']);
          }
        }else{
          echo json_encode(['code'=>'error', 'answer'=>'Неверно задана длительность']);
        }

      }

      break;
  }
}