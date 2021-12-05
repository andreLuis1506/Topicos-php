<?php

class User{
  private $id;
  private $login;
  private $email;
  private $passaword;
  private $created;
  private $lastAcess;
  private $status;
  private $pin;

  public static function auth(){
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM usuario WHERE login = :login";
    $sql = $connection->prepare($sql);
    $sql->bindValue(':login', $this->login);
    $sql->execute();

    if($sql->rowCount()){
      $result = $sql->fetch();

      if($result['senha'] === $this->password){
        $_SESSION['usr'] = $this->id;
        return true;
      }
    }
    
    throw new Exception("Usuario não encontrado");

  }
  

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



  //get n set 
  public function setlogin($login){
    $this->login = $login;
  }

  public function getLogin(){
    return $this->login;
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function getPassword(){
    return $this->password;
  }


  public function setEmail($email){
    $this->email = $email;
  }

  public function getEmail(){
    return $this->email;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function getStatus(){
    return $this->status;
  }


}