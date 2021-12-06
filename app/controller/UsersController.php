<?php

class UsersController{
  public function index(){
    $users = new User;
    $params['users'] = $users->getAll();

    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);

    if($_SESSION['login']){
      $params['login'] = $_SESSION['login'];
      $template = $twig->load('users.html');
      $content = $template->render($params);
    }
    else{
      $template = $twig->load('login.html');
      $content = $template->render();
    }

    echo $content;
  }
}