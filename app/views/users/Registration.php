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
    <form class="register" action="/User/register" method="post">
      <?= $data['error'] ?>
      <div>
        <h2>Location</h2>
        <div class="location">
          <input placeholder="City" type="text" name="city" value="<?= $data['city'] ?>">
          <input placeholder="Street" type="text" name="street" value="<?= $data['street'] ?>">
          <input placeholder="Streetnumber" type="text" name="streetnumber" value="<?= $data['streetnumber'] ?>">
          <input placeholder="Postalcode" type="text" name="postalcode" value="<?= $data['postalcode'] ?>">
        </div>
      </div>
      <div class="personal">
        <h2>Personal</h2>
        <div class="name">
          <input placeholder="Firstname" type="text" name="firstname" value="<?= $data['firstname'] ?>">
          <input placeholder="Infix" type="text" name="infix" value="<?= $data['infix'] ?>">
          <input placeholder="Lastname" type="text" name="lastname" value="<?= $data['lastname'] ?>">
        </div>
        <div class="other">
          <input placeholder="Age" type="number" name="age" value="<?= $data['age'] ?>">
          <input placeholder="Phone" type="text" name="phone" value="<?= $data['phone'] ?>">
          <input placeholder="Email" type="text" name="email" value="<?= $data['email'] ?>">
        </div>
      </div>
      <h2>Login</h2>
      <div class="registerLogin">
        <input placeholder="Username" type="text" name="username" value="<?= $data['username'] ?>">
        <input placeholder="Password" type="text" name="userpass" value="<?= $data['userpass'] ?>">
      </div>
      <input id="submit" type="submit" value="Register">
    </form>
  </main>
</body>

</html>