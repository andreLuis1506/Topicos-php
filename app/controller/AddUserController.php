<?php

class AddUserController {
  public function index(){
    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);

    if($_SESSION['login']){
      $params['login'] = $_SESSION['login'];
      $template = $twig->load('addUser.html');
      $content = $template->render($params);
    }
    else{
      $template = $twig->load('login.html');
      $content = $template->render();
    }

    echo $content;
  }

  public function create(){
    $user = new User;

    $user->setLogin($_POST['login']);
    $user->setPassword(password_hash($_POST['passwd'], PASSWORD_BCRYPT));
    $user->setPin(password_hash($_POST['pin'], PASSWORD_BCRYPT));
    $user->setEmail($_POST['email']);
    $user->create();

    $list = new AddUserController;
    $list->index();
  }
}