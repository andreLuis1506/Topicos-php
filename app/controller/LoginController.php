<?php 

class LoginController{
  public function index(){
    try{
      $users = User::getALL();
  
      var_dump($users);
    } 
    catch (Exeception $e){
      echo $e->getMessage();
    }
  }
}