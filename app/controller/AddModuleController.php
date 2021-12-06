<?php

class AddModuleController {
  public function index(){
    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);

    if($_SESSION['login']){
      $params['login'] = $_SESSION['login'];
      $template = $twig->load('addModule.html');
      $content = $template->render($params);
    }
    else{
      $template = $twig->load('login.html');
      $content = $template->render();
    }

    echo $content;
  }

  public function create(){
    $module = new Module;

    $module->setTitle($_POST['title']);
    $module->setDescription($_POST['description']);
    $module->create();

    $list = new ModuleController;
    $list->index();
  }
}