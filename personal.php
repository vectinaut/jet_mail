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
</head>
<body>

<?php include("app/include/header.php");?>

  <main class="main">
    <section class="subscribes">
      <div class="container subscribes-container">
        <h2 class="subscribes__title">
          Текущие подписки
        </h2>
        <ul class="subscribes-list list-resert flex">
          <li class="subscribes-list__item flex">
            <div class="subscribes-list__item-photo">
              <img src="assets/img/cat.png" alt="">
            </div>
            <div class="subscribes-list__item-content flex">
              <h3 class="subscribes-list__item-title">
                Котята спасут мир
              </h3>
              <span class="subscribes-list__item-descr">
                Комсомольская правда
              </span>
              <span class="subscribes-list__item-period">
                1 месяц
              </span>
            </div>
          </li>
        </ul>
      </div>
    </section>
    <section class="subscribes">
      <div class="container subscribes-container non-subscribes-container">
        <h2 class="subscribes__title">
          Истекшие подписки
        </h2>
        <ul class="subscribes-list list-resert flex">
          <li class="subscribes-list__item flex">
            <div class="subscribes-list__item-photo non-subscribes-list__item-photo">
              <img src="assets/img/cat.png" alt="">
            </div>
            <div class="subscribes-list__item-content flex">
              <h3 class="subscribes-list__item-title non-subscribes-list__item-title">
                Котята не спасут мир
              </h3>
              <span class="subscribes-list__item-descr non-subscribes-list__item-descr">
                Комсомольская правда
              </span>
              <span class="subscribes-list__item-period non-subscribes-list__item-period">
                3 месяца
              </span>
            </div>
          </li>
        </ul>
      </div>
    </section>
  </main>
<?php include ("app/include/footer.php")?>
</body>
</html>