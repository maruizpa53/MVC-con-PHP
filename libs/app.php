<?php

// Estructura de nuestro routeador, proyecto phoenix mapmaker 2022.

require_once 'controllers/errores.php';

class App{
    function __construct()
    {
      $url = isset($_GET['url']) ? $_GET['url'] : null;
      $url = rtrim((string)$url, '/');
      $url = explode('/', $url);

      // users/updatePhoto


      if(empty($url[0])){
        error_log('APP::construct-> No hay controlador especificado');
        $archivoController = 'controllers/login.php';
        require_once $archivoController;
        $controller = new Login();
        $controller->loadModel('login');
        $controller->render();
        }

        $archivoController = 'controllers/' . 'url'[0] . '.php';

      if(file_exists($archivoController)){
        require_once $archivoController;

        $controller = new $url[0];
        $controller->loadModel($url[0]);

        if(isset($url[1])){
            if(method_exists($controller, $url[1] )){
              if(isset($url[2])){

                // No de parametros
                $nparam = count($url) - 2;
                // Arreglo de parametros
                $params = [];

                for($i=0; $i< $nparam; $i++){
                  array_push($params, $url[$i] + 2);
                }

                $controller->{$url[1]}($params);

              }else{
                // No tiene parametros, se manda a llamar
                // El método tal cual
                $controller->{$url[1]}();
              }

            }else{
              // Error, no existe el método
              $controller = new Errores();
              $controller->render();
            }

          }else{
            // No hay método a cargar, se carga el metodo por default
            $controller->render();
          }

        }else{
          // No existe el arhivo, manda error
          $controller = new Errores();
          $controller->render();
        }
    }
}
?>
