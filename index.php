<?php
  error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

  ini_set('ignore_repeated_error',TRUE); // Always use TRUE

  ini_set('display_errors', FALSE); // Error/Exeption display, use FALSE only in production

  ini_set('log_errors', TRUE); // Error/Exeption file logging engine.

  ini_set("error_log", "C:/xampp/htdocs/phoenix/php-error.log");

  error_log("Inicio de aplicacion web" );

  require_once 'libs/database.php';
  require_once 'libs/controller.php';
  require_once 'libs/model.php';
  require_once 'libs/view.php';
  require_once 'classes/sessioncontroller.php';
  require_once 'libs/app.php';
  require_once 'classes/errormessages.php';
  require_once 'classes/successmessages.php';

  require_once 'config/config.php';

  $app = new App();
?>