
<header class="header">
    <div class="container header-container flex">
        <h1 class="header__title">
            <a href="index.php" class="header__link">
                JET MAIL
            </a>
        </h1>
        <div class="header_btns">
          <?php if(!isset($_SESSION['id'])): ?>
            <a href="log-in.php" class="header-btn">
                Войти
            </a>
          <?php endif; ?>

          <?php if(isset($_SESSION['id'])): ?>
            <a href="cart.php" class="header-btn">
              Корзина
            </a>
          <a href="personal.php" class="header-btn">
            <?php echo $_SESSION['name']; ?>
          </a>
            <a href="log-out.php" class="header-btn">
              Выход
            </a>
          <?php endif; ?>
        </div>
    </div>
</header>