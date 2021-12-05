<?php 

class LoginController{
  public function index(){
    $users = User::getALL();

    var_dump($users);
  }
}