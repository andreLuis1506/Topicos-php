<?php 

require_once 'app/core/core.php';
require_once 'app/lib/database/Connection.php';

require_once 'app/controller/ErrorController.php';
require_once 'app/controller/LoginController.php';

require_once 'app/model/User.php';

$template = file_get_contents('app/template/template.html');

ob_start();
  $core = new Core;
  $core->start($_GET);

  $result = ob_get_contents();
ob_end_clean();


$ready = str_replace('{{dynamic}}', $result, $template);
echo $ready;