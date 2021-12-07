<?php

class EditUserController {
  public function index(){
    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);

    $user = new User;
    $id = $_GET['id'];

    if($_SESSION['login']){
      $params['login'] = $_SESSION['login'];
      $params['user'] = $user->getById($id);

      $template = $twig->load('editUser.html');
      $content = $template->render($params);
    }
    else{
      $template = $twig->load('login.html');
      $content = $template->render();
    }

    echo $content;
  }

  public function save(){
    $user = new User;

    $id = $_GET['id'];
    $pin = $_POST['pin'];
    $user->setPassword(password_hash($_POST['passwd'], PASSWORD_BCRYPT));

    $my_user = $user->getById($_SESSION['id']);
    if(password_verify($_POST['pin'], $my_user->senha_assinatura)) {
      $user->edit($id);
    }

    

    $list = new UsersController;
    $list->index();
  }
}