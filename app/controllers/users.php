<?php
include ("app/database/db.php");

$errMsg = '';
$future = 0;

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

function check_subscription($user_id, $type, $future=0){
  $all_subs = selectAllSubscription(['user_id'=>$user_id]);

  if ($future){
    $current_date = date("Y-m-d", strtotime("+$future month", time()));
  }else{
    $current_date = date('Y-m-d', time());
  }

  $expired = [];
  $active = [];
  foreach ($all_subs as $key=>$value){
    $dataSince = date('Y-m-d', strtotime("+1 MONTH", strtotime($value['created'])));

//    $dataSince = date('Y-m-d', strtotime("+10 days", strtotime($value['created'])));

//    $dataSinceDataTime = new DateTime($dataSince);
//    $dataSinceDataTime = $dataSinceDataTime->modify('+10 day');
//    $dataSince = $dataSinceDataTime->format('Y-m-d');

    $duration = $value['duration']+1;
    $dateAt = strtotime("+$duration MONTH", strtotime($value['created']));
    $newDate = date('Y-m-d', $dateAt);

    $year = explode("-", $newDate)[0];
    $month = explode("-", $newDate)[1];
    $new_str_date = strtotime($year."-".$month."-01");

    $newDate = date('Y-m-d', $new_str_date);

    $newUntilDataTime = new DateTime($newDate);
    $newUntilDataTime = $newUntilDataTime->modify('-1 day');
    $newUntilDataTime = $newUntilDataTime->format('Y-m-d');

    if($current_date >= $newUntilDataTime){
      $expired['pub_id'][] = $value['pub_id'];
      $expired['duration'][] = $value['duration'];

      $year_since = explode("-", $dataSince)[0];
      $month_since = explode("-", $dataSince)[1];
      $expired['since'][] = $year_since."-".$month_since."-01";

      $expired['until'][] = $newUntilDataTime;

    }else{
      $active['pub_id'][] = $value['pub_id'];
      $active['duration'][] = $value['duration'];

      $year_since = explode("-", $dataSince)[0];
      $month_since = explode("-", $dataSince)[1];
      $active['since'][] = $year_since."-".$month_since."-01";

//      $year_until = explode("-", $newUntilDataTime)[0];
//      $month_until = explode("-", $newUntilDataTime)[1];
//      $active['until'][] = $year_until."-".$month_until."-01";
      $active['until'][] = $newUntilDataTime;



    }
  }
  if ($type==="active"){
    return $active;
  }else{
    return $expired;
  }
}
