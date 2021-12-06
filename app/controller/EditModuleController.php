<?php

class EditModuleController {
  public function index(){
    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);

    $module = new Module;
    $id = $_GET['id'];

    if($_SESSION['login']){
      $params['login'] = $_SESSION['login'];
      $params['module'] = $module->getById($id);

      $template = $twig->load('editModule.html');
      $content = $template->render($params);
    }
    else{
      $template = $twig->load('login.html');
      $content = $template->render();
    }

    echo $content;
  }

  public function save(){
    $module = new Module;

    $id = $_GET['id'];

    $module->setTitle($_POST['title']);
    $module->setDescription($_POST['description']);
    $module->edit($id);

    $list = new ModuleController;
    $list->index();
  }
}