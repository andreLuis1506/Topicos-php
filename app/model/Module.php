<?php

class Module{
  private $id;
  private $title;
  private $description;
  private $created;

  public static function getAll(){
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM modulo ORDER BY id DESC";
    $sql = $connection->prepare($sql);
    $sql->execute();

    $result = array();
    while($row = $sql->fetchObject('Module')){
      $result[] = $row;
    }

    if(!$result){
      throw new Exception("Não foi encontrado nenhum modulo.");
    }

    return $result;
  }
}
