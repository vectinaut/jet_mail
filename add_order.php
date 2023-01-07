<?php
include ("app/controllers/users.php");

if (isset($_GET['cart'])) {
  switch ($_GET['cart']) {
    case 'add_order':
      if(isset($_GET['type'])){
        if($_GET['type'] === 'cash'){
          $type = 0;
        }else{
          $type = 1;
        }
//        echo json_encode(['code'=>'ok', 'answer'=>'Кэш']);
        $user_id = $_COOKIE['user_id'];
//        echo json_encode(['code'=>'error', 'answer'=>$user_id]);
        $users = selectAll('user', ['id'=>$user_id]);

        // Проверка существования пользователя
        if(!empty($users)){
          $cart_items = selectAllCarts([
            'cart.status'=>1,
            'user_id'=>$user_id
          ], $less=True);

          //Проверка наличия товаров в корзине
          if(!empty($cart_items)){
            //Подсчет суммы заказа
            $total = 0;
            foreach ($cart_items as $key=>$value){
              $total += $value['price'] * $value['quantity'];
            }


            $order_id = insert('orders', [
              'user_id'=>$_COOKIE['user_id'],
              'status'=>1,
              'type'=>$type,
              'total'=>$total
            ]);

            //Проверка добавления в заказ
            if ($order_id){
              foreach ($cart_items as $key=>$value){
                insert('order_details', [
                  'order_id'=>$order_id,
                  'publication_id'=>$value['pub_id'],
                  'duration'=>$value['quantity']
                ]);
              }
              //Обновление значения в изданиях и удаление из корзины
              foreach ($cart_items as $key=>$value){
                $pub = selectOne('publication', ['publication_id'=>$value['pub_id']]);
                $new_amount = $pub['amount'] - 1;

                updatePublication($value['pub_id'], ['amount'=>$new_amount]);
//                updateCart($_COOKIE['user_id'], $value['pub_id'], ['status'=>0]);
              }
              $_SESSION['cart'] = selectAllCarts(['cart.status'=>1, 'user_id'=>$_COOKIE['user_id']], $less=True);
              echo json_encode(['code'=>'success', 'answer'=>'Товары заказаны']);

            }else{
              echo json_encode(['code'=>'reload', 'answer'=>'Ошибка при формирования заказа']);
              }
          }else{
            echo json_encode(['code'=>'reload', 'answer'=>'Корзина пуста']);
          }
        }else{
          echo json_encode(['code'=>'error', 'answer'=>'Такого пользователя нет']);
        }
      }
      break;
  }
}