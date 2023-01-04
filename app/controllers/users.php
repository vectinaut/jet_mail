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
    header('location: '."http://localhost/jet_mail/");
  }
  else{
    $errMsg = "Почта или пароль введены неверно!";
  }



}
