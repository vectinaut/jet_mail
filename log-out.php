<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);

header('location: '."http://localhost/jet_mail/");