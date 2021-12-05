<?php 

class LoginController{
  public function index(){
    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('Login.html');

    $content = $template->render();

    echo $content;

  }

  public function listUsers(){
    try {
      $users = User::getALL();
      var_dump($users);
    }
    catch (Exception $e){
      echo $e->getMessage();
    }
  }
}