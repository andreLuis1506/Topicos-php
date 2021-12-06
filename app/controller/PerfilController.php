<?php

class PerfilController{
  public function index(){

    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);
    if($_SESSION['id']){
      $template = $twig->load('perfil.html');
      $content = $template->render($_SESSION);
    }
    else{
      $template = $twig->load('login.html');
      $content = $template->render(array());
    }

    echo $content;
  }
}