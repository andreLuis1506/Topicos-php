<?php 

class LoginController{
  public function index(){
    try {
      $users = User::getALL();
      var_dump($users);
    }
    catch (Exception $e){
      echo $e->getMessage();
    }

  }
}