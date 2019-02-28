<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Whatsapp Newsletter - cozzydigital</title>

    <link href="css/1140.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style_main.css" rel="stylesheet">
  </head>

  <body>

    <div class="container12">

      <header>

        <div class="row">

          <div class="column7" id="header-nav">

            <a href="http://getcozzy.com"><img src=images/header_logo.png width=35% height=35%></a>

          </div>

          <div class="column5">

            <ul id="header-menu">

              <?php
                $_SESSION['user_id'] = '1';
                if (!isset($_SESSION['user_id'])) {
              ?>

              <li><a href="/login" class="color-link">Login</a></li>

              <?php } else { ?>

              <li><a href="/account" class="color-link">My Account</a></li>
              <li><a href="/logout">Logout</a></li>

              <?php } ?>

            </ul>

          </div>

        </div>

      </header>

    </div>

    <div class="sub-menu">

      <div class="container12">

        <div class="row">

          <div class="column3">
            <input type="submit" class="current-menu" name="dashboard" value="Dashboard">
          </div>
          <div class="column3">
            <input type="submit" class="menu-item" name="stats" value="Statistics">
          </div>
          <div class="column3">
            <input type="submit" class="menu-item" name="guides" value="Guides">
          </div>
          <div class="column3">
            <input type="submit" class="menu-item" name="about" value="About">
          </div>

      </div>

    </div>

  </body>
</html>
