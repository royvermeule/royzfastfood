<?php

namespace PHProx\Controllers;

use PHProx\Base\BaseController;
use PHProx\Checkers\DbChecker;
use PHProx\Checkers\SessionChecker;
use PHProx\Models\MenuModel;
use PHProx\Models\UserModel;

class Admin extends BaseController
{
  public function index()
  {
    //check if session is active
    $sessionChecker = new SessionChecker();
    if ($sessionChecker->checker() == false) {
      header("Refresh: 0; url=/User/login");
    }
    //check if the user is admin
    $checkRoll = new DbChecker();
    if ($checkRoll->checkRoll() == 'admin') {
      $userModel = new UserModel();
      $user = $userModel->getUserById($_SESSION['userId']);

      $data = [
        'title' => 'Admin panel',
        'username' => "<a href='/Account/index'>$user->username</a>"
      ];
      $this->view('admin/index', $data);
    } else {
      header("Refresh: 0; url=/Home/index");
    }
  }

  public function menuItems()
  {
    //check if session is active
    $sessionChecker = new SessionChecker();
    if ($sessionChecker->checker() == false) {
      header("Refresh: 0; url=/User/login");
    }
    //check if the user is admin
    $checkRoll = new DbChecker();
    if ($checkRoll->checkRoll() == 'admin') {
      //instantiate menumodel
      $menuModel = new MenuModel();
      $menuItems = $menuModel->getMenuItems();

      $rows = '';
      foreach ($menuItems as $value) {
        $rows .= "<tr>
          <td>$value->mit_id</td>
        </tr>";
      }
    } else {
      header("Refresh: 0; url=/Home/index");
    }
  }

  public function addMenuItem()
  {
    //check if session is active
    $sessionChecker = new SessionChecker();
    if ($sessionChecker->checker() == false) {
      header("Refresh: 0; url=/User/login");
    }
    //check if the user is admin
    $checkRoll = new DbChecker();
    if ($checkRoll->checkRoll() == 'admin') {
    } else {
      header("Refresh: 0; url=/Home/index");
    }
  }
}
