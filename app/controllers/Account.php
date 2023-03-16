<?php

namespace PHProx\Controllers;

use PHProx\Base\BaseController;
use PHProx\Checkers\SessionChecker;
use PHProx\Models\UserModel;

class Account extends BaseController
{
  public function index()
  {
    $sessionChecker = new SessionChecker();
    $sessionChecker->checkAndSendToLogin();

    $userId = $_SESSION['userId'];
    $userModel = new UserModel();
    $user = $userModel->getUserById($userId);
    $data = [
      'title' => 'My account',
      'username' => "<a href='/Account/index'>$user->username</a>"
    ];
    $this->view('users/account/index', $data);
  }
}
