<?php
include ("app/controllers/users.php");
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
  <script defer src="assets/js/registration.js"></script>
</head>
<body>

<?php include("app/include/header.php");?>

  <main class="main">
    <section class="log-in">
      <div class="container-limit log-in-container flex">
        <h2 class="log-in__title">
          Регистрация
        </h2>
        <form action="registration.php" class="log-in-form" method="post">
          <div class="log-in-form__input-box err">
            <p>
              <?=$errMsg?>
            </p>
          </div>
          <div class="log-in-form__input-box">
            <input name="name" class="log-in-form__input input-resert" type="text" id="name" placeholder="Имя">
          </div>
          <div class="log-in-form__input-box">
            <input name="phone-number" class="log-in-form__input input-resert" type="tel" id="tel" placeholder="Телефон">
          </div>
          <div class="log-in-form__input-box">
            <input name="email" class="log-in-form__input input-resert" type="email" id="email" placeholder="E-mail">
          </div>
          <div class="log-in-form__input-box">
            <input name="password" class="log-in-form__input input-resert" type="password" id="password" placeholder="Пароль">
          </div>
          <button name="button-reg" class="log-in__btn btn-resert" type="submit">
            Зарегистрироваться
          </button>
        </form>

        <a href="log-in.php" class="log-in__btn-small btn-resert">
          Войти
        </a>
      </div>
    </section>
  </main>
<?php include ("app/include/footer.php")?>
</body>
</html>