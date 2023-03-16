<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once APPROOT . '/views/includes/Head.php' ?>
</head>

<body>
  <header>
    <?php require_once APPROOT . '/views/includes/MainNav.php' ?>
  </header>
  <main>
    <form action="/User/login" method="post">
      <div class="errors">
        <?= $data['error'] ?>
      </div>
      <div class="login">
        <input type="text" name="username">
        <input type="text" name="userpass">
        <input type="submit" value="login">
      </div>
      <div class="register">
        <a href="/User/register">or register</a>
      </div>
    </form>
  </main>
</body>

</html>