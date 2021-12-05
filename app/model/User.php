<?php

class User{
  public static function getAll(){
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM usuario ORDER BY id DESC";
    $connection->prepare(sql);
    $connection->exec();

    $result = array();
    while($row = $sql->fetchObject('User')){
      $result[] = $row;
    }

    return $result;
  }
}