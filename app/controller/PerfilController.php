<?php

class PerfilController{
  public function index(){

    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);
    if($_SESSION['id']){
      $template = $twig->load('perfil.html');
      
    }
    else{
      $template = $twig->load('login.html');
    }
    
    echo $_SESSION['id'];
    $content = $template->render($_SESSION);

    echo $content;
  }
}