<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['update_cart']);

//$_SESSION['id'] = -1;


header('location: '."http://localhost/jet_mail/");