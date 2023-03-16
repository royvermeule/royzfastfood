<?php

namespace PHProx\Validators;

use PHProx\Base\BaseModel;

class UserValidator extends BaseModel
{
  private int $usernameLenMin;
  private int $usernameLenMax;

  private int $userpassLenMin;
  private int $userpassLenMax;

  public function __construct($usernameLenMin, $usernameLenMax, $userpassLenMin, $userpassLenMax)
  {
    $this->usernameLenMin = $usernameLenMin;
    $this->usernameLenMax = $usernameLenMax;

    $this->userpassLenMin = $userpassLenMin;
    $this->userpassLenMax = $userpassLenMax;
  }

  public function setLength($usernameLenMin, $usernameLenMax, $userpassLenMin, $userpassLenMax)
  {
    $this->usernameLenMin = $usernameLenMin;
    $this->usernameLenMax = $usernameLenMax;

    $this->userpassLenMin = $userpassLenMin;
    $this->userpassLenMax = $userpassLenMax;
  }

  public function validateUsername($post)
  {
    if ($post['username'] == '') {
      $usernameError = 'Please enter a username';
    } elseif (strlen($post['username']) < $this->usernameLenMin) {
      $usernameError = 'A username must be between ' . $this->usernameLenMin . ' and ' . $this->usernameLenMax . ' characters';
    } elseif (strlen($post['username']) > $this->usernameLenMax) {
      $usernameError = 'A username must be between ' . $this->usernameLenMin . ' and ' . $this->usernameLenMax . ' characters';
    } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $post['username'])) {
      $usernameError = 'The username you typed contains illegal symbols';
    } else {
      $usernameError = false;
    }
    return $usernameError;
  }

  public function validateUserpass($post)
  {
    if ($post['userpass'] == '') {
      $userpassError = 'Please enter a password';
    } elseif (strlen($post['userpass']) < $this->userpassLenMin) {
      $userpassError = 'A password must be between ' . $this->userpassLenMin . ' and ' . $this->userpassLenMax . 'characters';
    } elseif (strlen($post['userpass']) > $this->userpassLenMax) {
      $userpassError = 'A password must be between ' . $this->userpassLenMin . ' and ' . $this->userpassLenMax . 'characters';
    } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $post['userpass'])) {
      $userpassError = 'The password you typed contains illegal symbols';
    } else {
      $userpassError = false;
    }
    return $userpassError;
  }

  public function validateEmail($post)
  {
    if ($post['email'] == '') {
      $emailError = 'Please enter a email';
    } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
      $emailError = 'Please enter a valid email';
    } else {
      $emailError = false;
    }
    return $emailError;
  }

  public function validatePhone($post)
  {
    if ($post['phone'] == '') {
      $phoneError = 'Please enter a phonenumber';
    } elseif (strlen($post['phone']) < 10 or strlen($post['phone']) > 15) {
      $phoneError = 'Please enter a valid phonenumber';
    } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_¬-]/', $post['phone'])) {
      $phoneError = 'Please enter a valid phonenumber';
    } else {
      $phoneError = false;
    }
    return $phoneError;
  }

  public function validateFirstname($post)
  {
    if ($post['firstname'] == '') {
      $fNameError = 'Please enter your Firstname';
    } else {
      $fNameError = false;
    }
    return $fNameError;
  }

  public function validateLastname($post)
  {
    if ($post['lastname'] == '') {
      $lNameError = 'Please enter your Lastname';
    } else {
      $lNameError = false;
    }
    return $lNameError;
  }

  public function validateAge($post)
  {
    if ($post['age'] == '') {
      $ageError = false;
    } else {
      $ageError = false;
    }
    return $ageError;
  }

  public function validateLocationDetails($post)
  {
    if ($post['street'] == '' or $post['streetnumber'] == '' or $post['city'] == '' or $post['postalcode'] == '') {
      $locDetailsError = 'Please enter all required location details';
    } else {
      $locDetailsError = false;
    }
    return $locDetailsError;
  }
}
