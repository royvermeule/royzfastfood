<?php

namespace PHProx\Checkers;

use PHProx\Utill\SessionUtil;

class SessionChecker
{
  public function checkAndSendToLogin(): mixed
  {
    session_start();
    // if (!isset($_SESSION['userId'])) {
    //   session_destroy();
    //   header("Refresh: 0; url=/User/loginSessionUtill
    // } else {
    //   return true;
    // }

    return !isset($_SESSION['userId']) ? SessionUtil::destroySessionAndSendToPage('/User/login') : true;
  }

  public function checker(): mixed
  {
    session_start();
    // if (!isset($_SESSION['userId'])) {
    //   session_destroy();
    //   return false;
    // } else {
    //   return true;
    // }

    return !isset($_SESSION['userId']) ? SessionUtil::destroySessionAndReturnFalse() : true;
  }
}
