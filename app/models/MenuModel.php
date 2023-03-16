<?php

namespace PHProx\Models;

use PHProx\Base\BaseModel;

class MenuModel extends BaseModel
{
  public function getMenuItems()
  {
    $this->db->query("SELECT menuitems.*
                            ,mainitems.*
                            ,extras.*
                            ,sides.*
                            ,drinks.*
                      FROM menuitems
                      INNER JOIN mainitems
                      ON menuitems.mit_main_id = mainitems.main_id
                      INNER JOIN extras
                      ON menuitems.mit_extra_id = extras.extra_id
                      INNER JOIN sides
                      ON menuitems.mit_side_id = sides.side_id
                      INNER JOIN drinks
                      ON menuitems.mit_drink_id = drinks.drink_id");
    return $this->db->resultSet();
  }
}
