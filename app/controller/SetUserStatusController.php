<?php

class SetUserStatusController {
  public function index(){
    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);

    if($_SESSION['login']){
      $params['login'] = $_SESSION['login'];
      $params['user_id'] = $_GET['id'];
      $template = $twig->load('setUserStatus.html');
      $content = $template->render($params);
    }
    else{
      $template = $twig->load('login.html');
      $content = $template->render();
    }

    echo $content;
  }


  public function setStatus(){
    $user = new User;

    $id = $_GET['id'];
    $user->id = $id;
    $user_buffer = $user->getById($_GET['id']);
    $user->setStatus($user_buffer->status);
    $my_user = $user->getById($_SESSION['id']);
    if(password_verify($_POST['pin'], $my_user->senha_assinatura)) {
      $user->changeUserStatus();
    }
    
    $module = new UsersController;
    $module->index();

  }
}