<?php

namespace PHProx\Checkers;

class SessionChecker
{
  public function checkAndSendToLogin()
  {
    session_start();
    if (!isset($_SESSION['userId'])) {
      session_destroy();
      header("Refresh: 0; url=/User/login");
    } else {
      return true;
    }
  }

  public function checker()
  {
    session_start();
    if (!isset($_SESSION['userId'])) {
      session_destroy();
      return false;
    } else {
      return true;
    }
  }
}
