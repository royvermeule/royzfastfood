<?php

namespace PHProx\Controllers;

use PHProx\Base\BaseController;
use PHProx\Models\UserModel;
use PHProx\Validators\UserValidator;
use PHProx\Checkers\DbChecker;
use PHProx\Checkers\SessionChecker;

class User extends BaseController
{
  public function index()
  {
    //check if user is logged on 
    $sessionChecker = new SessionChecker();
    if ($sessionChecker->checker() == true) {
      header("Refresh: 0; url=/Home/index");
    }

    $data = [
      'title' => 'Login',
      'username' => '<a href="/User/index">Login</a>',
      'error' => ''
    ];

    $this->view('users/Login', $data);
  }

  public function login()
  {
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
      $dbChecker = new DbChecker();
      $ifUserExists = $dbChecker->checkIfUserExists($_POST);

      if ($ifUserExists == false) {
        $data = [
          'title' => 'Login',
          'username' => '<a href="/User/index">Login</a>',
          'error' => "<div class='error'>The given username is incorrect</div>",
        ];

        $this->view('users/login', $data);
      } else {
        session_start();
        $_SESSION['userId'] = $ifUserExists;
        $_SESSION['lastTime'] = time();
        echo 'Succes!';
        header("Refresh: 1; url=/Home/index");
      }
    } else {
      header("Refresh:0; url=/User/index");
    }
  }

  public function register()
  {
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
      $userVal = new UserValidator(8, 12, 12, 30);
      //instantiate all validators
      $usernameVal = $userVal->validateUsername($_POST);
      $userpassVal = $userVal->validateUserpass($_POST);
      $emailVal = $userVal->validateEmail($_POST);
      $phoneVal = $userVal->validatePhone($_POST);
      $ageVal = $userVal->validateAge($_POST);
      $locVal = $userVal->validateLocationDetails($_POST);
      $fnameVal = $userVal->validateFirstname($_POST);
      $lnameVal = $userVal->validateLastname($_POST);

      if (!$locVal == false) {
        $error = $locVal;
      } elseif (!$fnameVal == false) {
        $error = $fnameVal;
      } elseif (!$lnameVal == false) {
        $error = $lnameVal;
      } elseif (!$ageVal == false) {
        $error = $ageVal;
      } elseif (!$phoneVal == false) {
        $error = $phoneVal;
      } elseif (!$emailVal == false) {
        $error = $emailVal;
      } elseif (!$usernameVal == false) {
        $error = $usernameVal;
      } elseif (!$userpassVal == false) {
        $error = $userpassVal;
      } else {
        $error = false;
      }

      if (!$error == false) {
        $data = [
          'title' => 'Register',
          'username' => '<a href="/User/index">Login</a>',
          'error' => "<div class='error'>$error</div>",
          'city' => $_POST['city'],
          'street' => $_POST['street'],
          'streetnumber' => $_POST['streetnumber'],
          'postalcode' => $_POST['postalcode'],
          'firstname' => $_POST['firstname'],
          'infix' => $_POST['infix'],
          'lastname' => $_POST['lastname'],
          'age' => $_POST['age'],
          'email' => $_POST['email'],
          'username' => $_POST['username'],
          'userpass' => $_POST['userpass'],
          'phone' => $_POST['phone']
        ];
        $this->view('users/registration', $data);
      } else {
        $userModel = new UserModel();
        $userModel->createUser($_POST);
        header("Refresh: 0; url=/User/login");
      }
    } else {
      $data = [
        'title' => 'Register',
        'username' => '<a href="/User/index">Login</a>',
        'error' => '',
        'city' => '',
        'street' => '',
        'streetnumber' => '',
        'postalcode' => '',
        'firstname' => '',
        'infix' => '',
        'lastname' => '',
        'age' => '',
        'email' => '',
        'username' => '',
        'userpass' => '',
        'phone' => ''
      ];
      $this->view('users/registration', $data);
    }
  }

  public function logOf()
  {
    session_start();
    if (!isset($_SESSION['userId'])) {
      session_destroy();
      header("Refresh: 0; url=/User/index");
    } else {
      $_SESSION = array();
      session_destroy();
      header("Refresh: 0; url=/User/index");
    }
  }
}
