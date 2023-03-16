<?php

namespace PHProx\Base;

class BaseModel
{
  protected Database $db;

  public function __construct($db = new Database)
  {
    $this->db = $db;
  }
}
