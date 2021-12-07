<?php

class User{
  public $id;
  private $login;
  private $email;
  private $passaword;
  private $created;
  private $lastAcess;
  private $status;
  private $pin;

  public function auth(){
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM usuario WHERE login = :login LIMIT 1";
    $sql = $connection->prepare($sql);
    $sql->bindValue(':login', $this->login);
    $sql->execute();

    

    if($sql->rowCount()){
      $result = $sql->fetch();
      if(password_verify($this->password, $result['senha']) and $result['status'] == '1'){
        $dateNow = date("Y-m-d H:i:s");
        $sql = "UPDATE `usuario` SET `ultimo_acesso` = '" . $dateNow . "' WHERE `usuario`.`id` = " . $result['id'] . " ";
        $sql = $connection->prepare($sql);
        $sql->execute();
        $_SESSION['id'] = $result['id'];
        $_SESSION['login'] = $result['login'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['created'] = $result['criacao'];
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

  public function create(){
    $connection = Connection::getConnection();

    $sql = "INSERT INTO `usuario` (`login`, `senha`, `criacao`, `email`, `status`, `senha_assinatura`) VALUES ('$this->login', '$this->password', CURRENT_TIMESTAMP, '$this->email', '1', '$this->pin') ";
    $sql = $connection->prepare($sql);
    $sql->execute();
  }

  public function edit($id) {
    $connection = Connection::getConnection();
    $sql = "UPDATE `usuario` SET `senha` = '" . $this->password . "' WHERE `usuario`.`id` = " . $id . " ";
    $sql = $connection->prepare($sql);
    $sql->execute();
  }

  public function changeUserStatus() {
    $connection = Connection::getConnection();
    if($this->status == '0' ) {
      $this->status = '1';
    } else {
      $this->status = '0';
    }

    $sql = "UPDATE `usuario` SET `status` = '" . $this->status . "' WHERE `usuario`.`id` = " . $this->id . " ";
    $sql = $connection->prepare($sql);
    $sql->execute();
  }

  public function logout() {
    $_SESSION['id'] = null;
    $_SESSION['login'] = null;
    $_SESSION['email'] = null;
    $_SESSION['created'] = null;
  }

  public function getById($id){
    $connection = Connection::getConnection();

    $sql = "SELECT * FROM usuario WHERE id = '$id'";
    $sql = $connection->prepare($sql);
    $sql->execute();
    
    if($sql->rowCount()){
      $result = $sql->fetchObject();
        return $result;
      }
    
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

   
  public function setPin($pin) {
    $this->$pin = $pin;
  }

  public function getPin() {
    return $this->$pin;
  }

}