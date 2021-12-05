<?php 
class Core {
  public function start($urlGet){

    if (isset($urlGet['metodo'])) {
      $exec = $urlGet['metodo'];
    } else {
      $exec = 'index';
    }

    if(isset($urlGet['pagina'])){
      $page = ucfirst($urlGet['pagina'].'Controller');
    }
    else{
      $page = 'LoginController';
    }

    if(!class_exists($page)){
      $page = 'ErrorController';
    }

    call_user_func_array(array(new $page, $exec), array());
  }
}


?>