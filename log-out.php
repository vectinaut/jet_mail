<?php
//session_start();
include ("app/database/db.php");

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['update_cart']);
unset($_SESSION['cart']);
setcookie('user_id', '-1', time());
setcookie('close', 1, time()+999999);

//session_destroy();
//$_SESSION = [];

//$_SESSION['id'] = -1;


header('location: '."http://localhost/jet_mail/");