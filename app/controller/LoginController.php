<?php 

class LoginController{

  public function index($params = array()){
    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('login.html');

    $content = $template->render($params);

    echo $content;

  }

  public function login(){
    try{
      $user = new User;

      $user->setLogin($_POST['login']);
      $user->setPassword($_POST['password']);
      $user->auth();

      $perfil = new PerfilController;
      $params = array();
      
      $content = $perfil->index($params);
      
      echo $content;
      
    }
    catch(Exception $e){
      $params = array();

      $params['error'] = 'Falha ao fazer login, tente novamente';
      $content = $this->index($params);

      echo $content;
    }
  }

  public function listUsers(){
    try {
      $users = User::getALL();
    }
    catch (Exception $e){
      echo $e->getMessage();
    }
  }
  public function logout(){
    $user = new User;
    $user->logout();
    $this->index();
  }
}