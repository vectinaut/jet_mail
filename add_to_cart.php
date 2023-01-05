<?php
include ("app/controllers/users.php");

if (isset($_GET['cart'])) {
  switch ($_GET['cart']) {
    case 'add':
      $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
      $pub = selectOnePublication(['publication_id'=>$id]);
      if (!empty($pub)){
        $carts = selectAll('cart', [
          'user_id'=>$_COOKIE['user_id'],
          'publication_id'=>$id,
          'status'=>1]);

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
        echo json_encode(['code'=>'error', 'answer'=>'Ошибка товара']);
      }
      break;
  }
}


