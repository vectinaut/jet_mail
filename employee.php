<?php

include ('app/controllers/users.php');
if (!isset($_COOKIE['user_id']) || !$_SESSION['admin']){
  echo "<h1>403 Error</h1>";
  exit();
}

$wrongMsg = '';
$user_name = '';
$active_pub = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-btn'])){
  $email = trim($_POST['email']);
  $user = selectOne('user', ['email'=>$email]);

  if (!empty($user) && $user['status'] == 1){
    $wrongMsg = 'Введите почту пользователя';
  }
//  unset($_POST['search-btn']);
  if (!empty($user)){

    $user_name = $user['first_name'].". ";
    $active = check_subscription($user['id'], $type='active', $future);

    $active_pub = [];
    if($active){

      for ($i=0; $i<count($active['pub_id']); $i++){
        $pub = selectOne('publication',['publication_id'=>$active['pub_id'][$i]]);
        $active_pub[$i]['pub'] = $pub;
        $active_pub[$i]['duration'] = $active['duration'][$i];
        if ($active['status'][$i] == 1){
          $status = 'Оплачено';
        }else{
          $status = 'Не оплачено';
        }
        $active_pub[$i]['status'] = $status;

        $active_pub[$i]['since'] = $active['since'][$i];
        $active_pub[$i]['until'] = $active['until'][$i];
      }
    }
  }else{
    $wrongMsg = 'Пользователя с такой почтой не существует';
  }
}else{
  $active_pub = [];
}

?>

<!DOCTYPE html>
<html lang="en">
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
  <script defer src="assets/js/employee.js"></script>
</head>
<body>

  <?php include("app/include/header.php");?>

  <main class="main">
    <section class="employee">
      <div class="container employee-container flex">
        <form class="employee-search flex" method="post">
        <span class="employee-search__none">
            <?=$wrongMsg; ?>
        </span>
          <input name="email" id="email" class="employee-search__input" type="text" placeholder="Введите email пользователя">
          <button name="search-btn" type="submit" class="employee-search__btn btn-resert" aria-label="поиск по сайту">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M8.93382 1.70286C5.44752 1.70286 2.62132 4.52907 2.62132 8.01536C2.62132 11.5017 5.44752 14.3279 8.93382 14.3279C12.4201 14.3279 15.2463 11.5017 15.2463 8.01536C15.2463 4.52907 12.4201 1.70286 8.93382 1.70286ZM0.937988 8.01536C0.937988 3.59939 4.51784 0.0195312 8.93382 0.0195312C13.3498 0.0195313 16.9296 3.59939 16.9296 8.01536C16.9296 12.4313 13.3498 16.0112 8.93382 16.0112C4.51784 16.0112 0.937988 12.4313 0.937988 8.01536Z" fill="#333"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9602 12.8988C13.2846 12.5659 13.8175 12.559 14.1504 12.8834L20.1959 18.7751C20.5288 19.0995 20.5357 19.6324 20.2112 19.9653C19.8868 20.2982 19.3539 20.3051 19.021 19.9806L12.9756 14.089C12.6427 13.7645 12.6358 13.2317 12.9602 12.8988Z" fill="#333"/>
            </svg>
          </button>
        </form>
        <div class="user-subscribes">
          <h2 class="subscribes__title">
            <?=$user_name;?>Активные подписки
          </h2>
          <ul class="subscribes-list list-resert flex">
            <?php if ($active_pub): ?>
            <?php foreach ($active_pub as $key=>$value): ?>
            <a href="<?= "product.php?post=".$value['pub']['publication_id'];?>">
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
                  <span class="subscribes-list__item-status">
                    Статус: <?=$value['status']?>
                  </span>
                </div>
              </li>
            </a>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </section>

  </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!--<script src="assets/js/find_subscription.js"></script>-->
<?php include ("app/include/footer.php")?>

</body>
</html>