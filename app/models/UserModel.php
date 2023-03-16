<?php

namespace PHProx\Models;

use PHProx\Base\BaseModel;

class UserModel extends BaseModel
{
  public function getUsers()
  {
    $this->db->query("SELECT User.*
                            ,Login.*
                            ,Person.*
                            ,Roll.*
                      FROM User
                      INNER JOIN Login
                      ON user.user_login_id = login.login_id
                      INNER JOIN Person
                      ON user.user_person_id = person.person_id
                      INNER JOIN Roll
                      ON user.user_roll_id = roll.roll_id");

    return $this->db->resultSet();
  }

  public function getUserByUsername($post)
  {
    $this->db->query("SELECT User.*
                            ,Login.*
                            ,Person.*
                            ,Roll.*
                        FROM User
                        INNER JOIN Login
                        ON user.user_login_id = login.login_id
                        INNER JOIN Person
                        ON user.user_person_id = person.person_id
                        INNER JOIN Roll
                        ON user.user_roll_id = roll.roll_id
                        WHERE login.username = :username");
    $this->db->bind(':username', $post['username']);

    return $this->db->single();
  }

  public function getUserById($userId)
  {
    $this->db->query("SELECT User.*
                            ,Login.*
                            ,Person.*
                            ,Roll.*
                        FROM User
                        INNER JOIN Login
                        ON user.user_login_id = login.login_id
                        INNER JOIN Person
                        ON user.user_person_id = person.person_id
                        INNER JOIN Roll
                        ON user.user_roll_id = roll.roll_id
                        WHERE user.user_id = :userId");
    $this->db->bind(':userId', $userId);

    return $this->db->single();
  }

  public function createUser($post)
  {
    $this->db->query("INSERT INTO Login (username, userpass) values(:username, :userpass)");
    $this->db->bind(':username', $post['username']);
    $this->db->bind(':userpass', $post['userpass']);
    $this->db->execute();
    $loginId = $this->db->dbHandler->lastInsertId();

    $this->db->query("INSERT INTO Person (firstname, infix, lastname, email, phone, age, city, street, number, postalcode)
                      values(:firstname, :infix, :lastname, :email, :phone, :age, :city, :street, :number, :postalCode)");
    $this->db->bind(':firstname', $post['firstname']);
    $this->db->bind(':infix', $post['infix']);
    $this->db->bind(':lastname', $post['lastname']);
    $this->db->bind(':email', $post['email']);
    $this->db->bind(':phone', $post['phone']);
    $this->db->bind(':age', $post['age'], \PDO::PARAM_INT);
    $this->db->bind(':city', $post['city']);
    $this->db->bind(':street', $post['street']);
    $this->db->bind(':number', $post['streetnumber'], \PDO::PARAM_INT);
    $this->db->bind(':postalCode', $post['postalcode']);
    $this->db->execute();
    $personId = $this->db->dbHandler->lastInsertId();

    $this->db->query("INSERT INTO User (user_login_id, user_person_id, user_roll_id) values(:login_id, :person_id, :roll_id)");
    $this->db->bind(':login_id', $loginId, \PDO::PARAM_INT);
    $this->db->bind(':person_id', $personId, \PDO::PARAM_INT);
    $this->db->bind(':roll_id', 2, \PDO::PARAM_INT);
    $this->db->execute();
  }
}
