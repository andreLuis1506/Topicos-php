<?php

class ModuleController{
  public function index(){
    $modules = new Module;
    $params['modules'] = $modules->getAll();

    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);

    if($_SESSION['login']){
      $params['login'] = $_SESSION['login'];
      $template = $twig->load('module.html');
      $content = $template->render($params);
    }
    else{
      $template = $twig->load('login.html');
      $content = $template->render();
    }

    echo $content;
  }

  public function delete(){
    $module = new Module;

    $id = $_GET['id'];

    $module->delete($id);
    $this->index();
  }

}