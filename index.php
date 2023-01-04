<?php
include ('app/database/db.php');
$publications = selectAll('publication');
//tt($publications);
//exit();
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
    <section class="hero">
      <div class="container hero-container">
        <div class="hero-search flex">
          <input class="hero-search__input" type="text" placeholder="Я ищу...">
          <button class="hero-search__btn btn-resert" aria-label="поиск по сайту">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M8.93382 1.70286C5.44752 1.70286 2.62132 4.52907 2.62132 8.01536C2.62132 11.5017 5.44752 14.3279 8.93382 14.3279C12.4201 14.3279 15.2463 11.5017 15.2463 8.01536C15.2463 4.52907 12.4201 1.70286 8.93382 1.70286ZM0.937988 8.01536C0.937988 3.59939 4.51784 0.0195312 8.93382 0.0195312C13.3498 0.0195313 16.9296 3.59939 16.9296 8.01536C16.9296 12.4313 13.3498 16.0112 8.93382 16.0112C4.51784 16.0112 0.937988 12.4313 0.937988 8.01536Z" fill="#333"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9602 12.8988C13.2846 12.5659 13.8175 12.559 14.1504 12.8834L20.1959 18.7751C20.5288 19.0995 20.5357 19.6324 20.2112 19.9653C19.8868 20.2982 19.3539 20.3051 19.021 19.9806L12.9756 14.089C12.6427 13.7645 12.6358 13.2317 12.9602 12.8988Z" fill="#333"/>
            </svg>
          </button>
        </div>
      </div>
    </section>
    <section class="publications">
      <div class="container publications-container">
<!--        <h2 class="publications__title">-->
<!--          Популярные издания-->
<!--        </h2>-->
        <ul class="publications-list list-resert flex">
          <?php foreach ($publications as $key => $value): ?>
          <li class="publications-list__item flex">
            <div class="publications-list__item-photo">
              <img src="assets/img/posts/<?php echo $value['img']?>" alt="">
            </div>
            <a href=<?= "http://localhost/jet_mail/"."product.php?post=".$value['publication_id'];?> class="publications-list__item-title">
              <?php echo $value['name']; ?>
            </a>
            <span class="publications-list__item-company">
              <?php echo $value['type']; ?>
            </span>
            <span class="publications-list__item-company">
              <?php echo $value['number_pages']; ?> страниц
            </span>
            <div class="publications-list__item-bottom flex">

              <span class="publications-list__item-price">
                <?php echo $value['price']?>р.
              </span>
              <button class="publications-list__item-cart btn-resert" >
                <svg class="header-btns__btn-icon" width="23" height="20" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2214 15.4665C10.3829 15.9206 10.8452 16.1949 11.3212 16.119L24.0874 14.0828C24.5004 14.017 24.8288 13.701 24.9106 13.2909L26.2654 6.49865C26.3875 5.88644 25.925 5.31324 25.3008 5.30317L7.94122 5.02324C7.24354 5.01199 6.74913 5.70067 6.98289 6.35812L10.2214 15.4665Z" fill="#666"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8262 23.3593C12.1109 23.3593 13.1523 22.3178 13.1523 21.0331C13.1523 19.7484 12.1109 18.707 10.8262 18.707C9.54146 18.707 8.5 19.7484 8.5 21.0331C8.5 22.3178 9.54146 23.3593 10.8262 23.3593Z" fill="#666"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M22.457 23.3593C23.7417 23.3593 24.7831 22.3178 24.7831 21.0331C24.7831 19.7484 23.7417 18.707 22.457 18.707C21.1723 18.707 20.1308 19.7484 20.1308 21.0331C20.1308 22.3178 21.1723 23.3593 22.457 23.3593Z" fill="#666"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M4 2C5.933 2 7.5 1.77614 7.5 1.5C7.5 1.22386 5.933 1 4 1C2.067 1 0.5 1.22386 0.5 1.5C0.5 1.77614 2.067 2 4 2Z" fill="#666"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M1.45442 0.651472C2.1177 0.556717 3.01745 0.5 4 0.5C4.98255 0.5 5.8823 0.556717 6.54558 0.651472C6.87345 0.69831 7.16489 0.757343 7.38495 0.831667C7.4917 0.867722 7.61185 0.917169 7.71511 0.989256C7.80017 1.04864 8 1.21275 8 1.5C8 1.78725 7.80017 1.95136 7.71511 2.01074C7.61185 2.08283 7.4917 2.13228 7.38495 2.16833C7.16489 2.24266 6.87345 2.30169 6.54558 2.34853C5.8823 2.44328 4.98255 2.5 4 2.5C3.01745 2.5 2.1177 2.44328 1.45442 2.34853C1.12655 2.30169 0.835108 2.24266 0.615051 2.16833C0.508302 2.13228 0.388151 2.08283 0.284892 2.01074C0.199835 1.95136 0 1.78725 0 1.5C0 1.21275 0.199835 1.04864 0.284892 0.989256C0.388151 0.917169 0.508302 0.867722 0.615051 0.831667C0.835108 0.757343 1.12655 0.69831 1.45442 0.651472Z" fill="#666"/>
                </svg>
              </button>

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