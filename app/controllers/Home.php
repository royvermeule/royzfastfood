<?php

namespace PHProx\Controllers;

use PHProx\Base\BaseController;
use PHProx\Checkers\SessionChecker;
use PHProx\Models\UserModel;

class Home extends BaseController
{
  public function index()
  {
    //if user is not logged on ->
    $sessionChecker = new SessionChecker();
    if ($sessionChecker->checker() == false) {
      $data = [
        'title' => 'The best fast food restaurant!',
        'username' => '<a href="/User/index">Login</a>'
      ];

      $this->view('homepages/index', $data);
    } else {
      $userId = $_SESSION['userId'];
      $userModel = new UserModel();
      $user = $userModel->getUserById($userId);
      $data = [
        'title' => 'The best fast food restaurant!',
        'username' => "<a href='/Account/index'>$user->username</a>"
      ];

      $this->view('homepages/index', $data);
    }
  }
}
