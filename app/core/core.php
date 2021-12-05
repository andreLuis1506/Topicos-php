<?php 
class Core {
  public function start($urlGet){

    if(isset($urlGet['pagina'])){
      $page = ucfirst($urlGet['pagina'].'Controller');
    }
    else{
      $page = 'LoginController';
    }
    $exec = 'index';

    if(!class_exists($page)){
      $page = 'ErrorController';
    }

    call_user_func_array(array(new $page, $exec), array());
  }
}


?>