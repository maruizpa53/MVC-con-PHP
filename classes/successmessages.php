<?php

class SuccessMessages{

    // SUCCESS_CONTROLLER_METHOD_ACTION

    const PRUEBA                  = "b4e3ddb267f3d1c0347b5b9213abeedb";
    const SUCCESS_SIGNUP_NEWUSER  = "2ee085ac8828407f4908e4d134195e5c";

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
          SuccessMessages::PRUEBA => 'Este es un ejemplo de un mensaje exitoso',
          SuccessMessages::SUCCESS_SIGNUP_NEWUSER => 'Nuevo usuario registrado correctamente' 
        ];
    }

    public function get($hash){
      return $this->successList[$hash];
    }

    public function existsKey($key){
      if(array_key_exists($key, $this->successList)){
        return true;
      }else{
        return false;
      }
    }
}
?>