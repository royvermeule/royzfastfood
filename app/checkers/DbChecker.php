<?php

namespace PHProx\Checkers;

use PHProx\Models\UserModel;

class DbChecker
{
  public function checkIfUserExists($post)
  {
    $userModel = new UserModel();
    $getByUsername = $userModel->getUserByUsername($post);

    if (!$getByUsername == null) {
      $userId = $getByUsername->user_id;
      $getUserById = $userModel->getUserById($userId);
      if ($getUserById->userpass == $post['userpass']) {
        $exists = $getUserById->user_id;
      } else {
        $exists = false;
      }
    } else {
      $exists = false;
    }

    return $exists;
  }

  public function checkIfUsernameExists($post)
  {
    $userModel = new UserModel();
    $getByUsername = $userModel->getUserByUsername($post);

    if ($getByUsername !== null) {
      $exists = true;
    } else {
      $exists = false;
    }
    return $exists;
  }

  public function checkRoll()
  {
    $userId = $_SESSION['userId'];
    $userModel = new UserModel();
    $userRoll = $userModel->getUserById($userId);
    if ($userRoll->user_roll_id == 1) {
      $roll = 'admin';
    } elseif ($userRoll->user_roll_id == 2) {
      $roll = 'user';
    }
    return $roll;
  }
}
