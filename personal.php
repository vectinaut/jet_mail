<?php
include ("app/controllers/users.php");
if (!isset($_COOKIE['user_id'])){
  echo "<h1>403 Error</h1>";
  exit();
}

$active = check_subscription($_COOKIE['user_id'], $type='active', $future);
$expired = check_subscription($_COOKIE['user_id'], $type='expired', $future);

$active_pub = [];
$expired_pub = [];
if($active){
  for ($i=0; $i<count($active['pub_id']); $i++){
    $pub = selectOne('publication',['publication_id'=>$active['pub_id'][$i]]);
    $active_pub[$i]['pub'] = $pub;
    $active_pub[$i]['duration'] = $active['duration'][$i];

    $active_pub[$i]['since'] = $active['since'][$i];
    $active_pub[$i]['until'] = $active['until'][$i];
  }
}

if($expired){
  for ($i=0; $i<count($expired['pub_id']); $i++){
    $pub = selectOne('publication',['publication_id'=>$expired['pub_id'][$i]]);
    $expired_pub[$i]['pub'] = $pub;
    $expired_pub[$i]['duration'] = $expired['duration'][$i];

    $expired_pub[$i]['since'] = $expired['since'][$i];
    $expired_pub[$i]['until'] = $expired['until'][$i];
  }
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
          <?php foreach ($active_pub as $key=>$value): ?>
          <a href="<?= "http://localhost/jet_mail/"."product.php?post=".$value['pub']['publication_id'];?>">
          <li class="subscribes-list__item flex">
            <div class="subscribes-list__item-photo">
              <img src="assets/img/posts/<?=$value['pub']['img'] ?>" alt="">
            </div>
            <div class="subscribes-list__item-content flex">
              <h3 class="subscribes-list__item-title">
                <?php echo $value['pub']['name']; ?>
              </h3>
              <span class="subscribes-list__item-descr">
                <?php echo $value['pub']['type']; ?>
              </span>
              <span class="subscribes-list__item-period">
                <?php if ($value['duration'] == 1): ?>
                <?=$value['duration']?> месяц
                <?php elseif ($value['duration'] == 3): ?>
                <?=$value['duration']?> месяца
                <?php else: ?>
                <?=$value['duration']?> месяцев
                <?php endif; ?>
              </span>
              <span class="subscribes-list__item-period">
                С: <?=$value['since']?> До: <?=$value['until']?>
              </span>
            </div>
          </li>
          </a>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
    <section class="subscribes">
      <div class="container subscribes-container non-subscribes-container">
        <h2 class="subscribes__title">
          Истекшие подписки
        </h2>
        <ul class="subscribes-list list-resert flex">
          <?php foreach ($expired_pub as $key=>$value): ?>
          <li class="subscribes-list__item flex">
            <div class="subscribes-list__item-photo non-subscribes-list__item-photo">
              <a href="<?= "http://localhost/jet_mail/"."product.php?post=".$value['pub']['publication_id'];?>">
              <img src="assets/img/posts/<?=$value['pub']['img'] ?>" alt="">
              </a>
            </div>
            <div class="subscribes-list__item-content flex">
              <h3 class="subscribes-list__item-title non-subscribes-list__item-title">
                <?php echo $value['pub']['name']; ?>
              </h3>
              <span class="subscribes-list__item-descr non-subscribes-list__item-descr">
                <?php echo $value['pub']['type']; ?>
              </span>
              <span class="subscribes-list__item-period non-subscribes-list__item-period">
                <?php if ($value['duration'] == 1): ?>
                  <?=$value['duration']?> месяц
                <?php elseif ($value['duration'] == 3): ?>
                  <?=$value['duration']?> месяца
                <?php else: ?>
                  <?=$value['duration']?> месяцев
                <?php endif; ?>
              </span>
              <span class="subscribes-list__item-period">
                С: <?=$value['since']?> До: <?=$value['until']?>
              </span>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
  </main>
<?php include ("app/include/footer.php")?>
</body>
</html>