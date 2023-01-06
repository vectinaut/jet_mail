<?php
include ("app/database/db.php");

$errMsg = '';

// Код для регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){
  $name = trim($_POST['name']);
  $phone_number = trim($_POST['phone-number']);
  $email = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $status = '1';

  if ($name === '' || $phone_number === '' || $email === '' || $password === '') {
    $errMsg = "Не все поля заполнены!";
  }
  elseif (mb_strlen($name, 'UTF-8') < 2){
    $errMsg = "Длина имени должна быть больше 2 символов";
  }

//  elseif (mb_strlen())

  $existence = selectOne('user', ['email' => $email]);

  if(!empty($existence)){
    $errMsg = "Пользователь с такой почтой уже зарегистрирован!";
//    tt($errMsg);
  }
  else{
    $post = [
      'first_name' => $name,
      'email' => $email,
      'phone_number' => $phone_number,
      'password' => $password,
      'status' => $status
    ];

    $id = insert('user', $post);
    $user = selectOne('user', ['id' => $id]);

    $_SESSION['id']= $user['id'];
    $_SESSION['name']= $user['first_name'];
    $_SESSION['email']= $user['email'];
    setcookie('user_id', $_SESSION['id'], time()+$time);
    setcookie('close', 0, time()+99999);
    header('location: '."http://localhost/jet_mail/");
//    tt($_SESSION);
//    exit();
  }

}else{
//  echo 'GET';
  $name = '';
  $email = '';
}

// Код для авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if ($name === '' || $phone_number === '' || $email === '' || $password === '') {
    $errMsg = "Не все поля заполнены!";
  }

  $existence = selectOne('user', ['email' => $email]);
//  tt($existence);
//  exit();

  if($existence && password_verify($password, $existence['password'])){
    $_SESSION['id']= $existence['id'];
    $_SESSION['name']= $existence['first_name'];
    $_SESSION['email']= $existence['email'];
    setcookie('user_id', $_SESSION['id'], time()+$time);
    setcookie('close', 0, time()+9999);
    header('location: '."http://localhost/jet_mail/");
  }
  else{
    $errMsg = "Почта или пароль введены неверно!";
  }



}

function check_subscription($user_id, $type){
  $all_subs = selectAllSubscription(['user_id'=>$user_id]);
  $current_date = date('Y.m.d', time());
//  $current_date = date("Y.m.d", strtotime("+5 month"));
  $expired = [];
  $active = [];
  foreach ($all_subs as $key=>$value){
    $duration = $value['duration']+1;
    $dateAt = strtotime("+$duration MONTH", strtotime($value['created']));
    $newDate = date('Y.m.d', $dateAt);

    if($current_date >= $newDate){
      $expired['pub_id'][] = $value['pub_id'];
      $expired['duration'][] = $value['duration'];
    }else{
      $active['pub_id'][] = $value['pub_id'];
      $active['duration'][] = $value['duration'];
    }
  }
  if ($type==="active"){
    return $active;
  }else{
    return $expired;
  }
}
