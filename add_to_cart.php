<?php
include ("app/controllers/users.php");

if (isset($_GET['cart'])) {
  switch ($_GET['cart']) {
    case 'add':
      $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
      $pub = selectOnePublication(['publication_id'=>$id]);
      if (!empty($pub) && $pub['amount']>0){
        $carts = selectAll('cart',
          ['user_id'=>$_COOKIE['user_id'],
          'publication_id'=>$id,
          'status'=>1]);
        $active = check_subscription($_COOKIE['user_id'], $type='active', $future);
        if (empty($active['pub_id']) || !in_array($id, $active['pub_id'])){

          // Проверка добавлен ли товар уже в корзину
          if(empty($carts)){
            $params = [
              'user_id' => $_COOKIE['user_id'],
              'publication_id' => $id,
              'status' => 1
            ];
            insert('cart', $params);
            echo json_encode(['code'=>'ok', 'answer'=>'Товар добавлен в корзину']);

          }else{
            echo json_encode(['code'=>'ok', 'answer'=>'Товар ранее уже был добавлен в корзину']);
          }
        }else{
          echo json_encode(['code'=>'error', 'answer'=>'У Вас уже есть подписка на это издание']);
        }
      }else{
        echo json_encode(['code'=>'error', 'answer'=>'Ошибка товара']);
      }
      break;
  }
}


