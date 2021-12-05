<?php

class User{
  public static function getAll(){
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM usuario ORDER BY id DESC";
    $sql = $connection->prepare($sql);
    $sql->execute();

    $result = array();
    while($row = $sql->fetchObject('User')){
      $result[] = $row;
    }

    if(!$result){
      throw new Exception("Não foi encontrado nenhum usario.");
    }

    return $result;
  }
}