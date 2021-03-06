<?php 

date_default_timezone_set('America/Bahia'); 

session_start();

require_once 'app/core/core.php';
require_once 'app/lib/database/Connection.php';

require_once 'app/controller/ErrorController.php';
require_once 'app/controller/LoginController.php';
require_once 'app/controller/PerfilController.php';
require_once 'app/controller/UsersController.php';
require_once 'app/controller/ModuleController.php';
require_once 'app/controller/AddModuleController.php';
require_once 'app/controller/EditModuleController.php';
require_once 'app/controller/AddUserController.php';
require_once 'app/controller/SetUserStatusController.php';
require_once 'app/controller/EditUserController.php';

require_once 'app/model/User.php';
require_once 'app/model/Module.php';

require_once 'vendor/autoload.php';

$template = file_get_contents('app/template/template.html');

ob_start();
  $core = new Core;
  $core->start($_GET);

  $result = ob_get_contents();
ob_end_clean();


$ready = str_replace('{{dynamic}}', $result, $template);
echo $ready;