
<header class="header">
    <div class="container header-container flex">
        <h1 class="header__title">
          <a href="index.php" class="header__link">
              JET MAIL
          </a>
        </h1>
        <div class="header_btns">
          <?php if(!isset($_COOKIE['user_id'])): ?>
            <a href="log-in.php" class="header-btn">
                Войти
            </a>
          <?php endif; ?>

          <?php if(isset($_COOKIE['user_id'])): ?>
          <?php if(!$_SESSION['admin']): ?>
            <a href="cart.php" class="header-btn">
              Корзина
            </a>
            <a href="personal.php" class="header-btn">
              <?php echo $_SESSION['name']; ?>
            </a>
            <a href="log-out.php" class="header-btn">
              Выход
            </a>
          <?php else: ?>
              <a class="header-btn admin">
                Режим адиминистратора
              </a>
            <a href="employee.php" class="header-btn">
              <?php echo $_SESSION['name']; ?>
            </a>
            <a href="log-out.php" class="header-btn">
              Выход
            </a>
          <?php endif; ?>
          <?php endif; ?>
        </div>
    </div>
</header>