<?php

class SuccessMessages{

    // SUCCESS_CONTROLLER_METHOD_ACTION

    const PRUEBA = "39e1d94aaae41a3ab7c6f71dd2d6f5e3";
    const SUCCESS_SIGNUP_NEWUSER = "5x6WEe1d94aaae41a3ab7c6f71dd2d6f5e3";

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