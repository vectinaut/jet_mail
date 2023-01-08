<?php
include ("app/controllers/users.php");
if (!isset($_COOKIE['user_id']) || $_SESSION['admin']){
  echo "<h1>403 Error</h1>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>JET MAIL</title>
  <script defer src="assets/js/payment.js"></script>
</head>
<body>

<?php include("app/include/header.php");?>

  <main class="main">
    <section class="log-in">
      <div class="container-limit log-in-container flex">
        <h2 class="log-in__title">
          Оплата
        </h2>
        <form action="#" class="log-in-form">
          <div class="log-in-form__input-box">
            <input class="log-in-form__input input-resert" type="text" id="number" placeholder="Номер карты">
          </div>
          <div class="log-in-form__input-box log-in-form__input-box-card">
            <input class="log-in-form__input input-resert" type="number" id="year" placeholder="Год действия">
          </div>
          <div class="log-in-form__input-box log-in-form__input-box-card">
            <input class="log-in-form__input input-resert" type="password" id="cvc" placeholder="CVC">
          </div>
        </form>
        <button class="log-in__btn btn-resert">
          Оплатить
        </button>
      </div>
    </section>
  </main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="assets/js/order.js"></script>
<?php include ("app/include/footer.php")?>
</body>
</html>