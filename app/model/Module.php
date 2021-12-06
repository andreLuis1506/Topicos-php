<?php

class Module{
  public $id;
  private $title;
  private $description;
  private $created;

  public function getAll(){
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM modulo ORDER BY id DESC";
    $sql = $connection->prepare($sql);
    $sql->execute();

    $result = array();
    while($row = $sql->fetchObject('Module')){
      $result[] = $row;
    }

    if(!$result){
      return false;
    }

    return $result;
  }
  public function create(){
    $connection = Connection::getConnection();

    $module = new Module;

    $this->setTitle($_POST['title']);
    $this->setDescription($_POST['description']);
    // $module->setCreated(date('m-d-Y h:i:s a', time()));
    $sql = "INSERT INTO modulo (id, titulo, descricao, data_criacao) VALUES (NULL, '$this->title', '$this->description', CURRENT_TIMESTAMP)";
    $sql = $connection->prepare($sql);
    $sql->execute();
  }

  public function delete($id){
    $connection = Connection::getConnection();
    $sql = "DELETE FROM modulo WHERE id = '$id'";
    $sql = $connection->prepare($sql);
    $sql->execute();
  }

  public function getById($id){
    $connection = Connection::getConnection();

    $sql = "SELECT * FROM modulo WHERE id = '$id'";
    $sql = $connection->prepare($sql);
    $sql->execute();
    
    if($sql->rowCount()){
      $result = $sql->fetchObject();
        return $result;
      }
    
  }

  public function edit($id){
    $connection = Connection::getConnection();

    $sql = "UPDATE modulo SET titulo = '$this->title', descricao = '$this->description' WHERE id ='$id'";
    $sql = $connection->prepare($sql);
    $sql->execute();
  }


  public function setTitle($title){
    $this->title = $title;
  }

  public function getTitle(){
    return $this->title;
  }

  public function setDescription($description){
    $this->description = $description;
  }

  public function getDescription(){
    return $this->description;
  }
}
