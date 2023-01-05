<?php
include ("app/controllers/users.php");

$post = $_GET['post'];
$publication = selectOnePublication(['publication_id'=>$post]);

//tt($publication);
//exit();
?>

<?php if (empty($publication) && $publication['amount']==0):?>
<h1>404 Not Found</h1>
<?php exit(); ?>
<?php endif;?>

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
    <div class="header-bottom-container">
      <div class="container">
        <a href="index.php" class="header__link flex">
          <span class="header__link-icon">
            <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.3417 8.91208C14.966 9.29821 14.3477 9.30437 13.9644 8.92579L8.14183 3.17475C8.06342 3.0973 7.93715 3.09788 7.85945 3.17603L2.15281 8.91591C1.76725 9.30371 1.14293 9.3137 0.745162 8.93845C0.335488 8.55196 0.321627 7.90488 0.714373 7.5012L7.28326 0.749487C7.67588 0.345934 8.32412 0.345934 8.71674 0.749487L15.3417 7.55884C15.7082 7.93549 15.7082 8.53542 15.3417 8.91208Z" fill="#A0A0A4"/>
            </svg>
          </span>
          <span class="header__link-text"> Продолжить покупки </span>
        </a>    
      </div>  
    </div>
  <main class="main">
    <section class="product">
      <div class="container product-container">
        <h2 class="product__title">
          <?=$publication['name']?>
        </h2>
        <div class="product__content flex">
          <div class="product__content-descr flex">
            <div class="product__content-photo">
              <img src="assets/img/posts/<?=$publication['img']?>" alt="">
            </div>
            <p class="product__content-text">
              <?=$publication['description']?>
            </p>
          </div>
          
          <div class="product__content-price-block flex">
            <span class="product__content-price">
              <?=$publication['price']?>р. в месяц
            </span>
            <form method="post" action="http://localhost/jet_mail/cart.php">
              <button value="<?=$publication['publication_id']?>" name="add-cart" class="product__content-btn btn-resert">
                <?php $_SESSION['update_cart']=1;?>
                Добавить в корзину
              </button>
            </form>

          </div>
        </div>
      </div>
    </section>
  </main>
<?php include ("app/include/footer.php")?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="assets/js/add_to_cart.js"></script>
</body>
</html>