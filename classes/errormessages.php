<?php 

class ErrorMessages{

    // ERROR_CONTROLLER_METHOD_ACTION

    const PRUEBA = "39e1d94aaae41a3ab7c6f71dd2d6f5e3";
    const ERROR_SIGNUP_NEWUSER = "49e1d09aaae41a3ab7c6f62dd2d6f5e3";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "h432ed09nbaao41a3ab7c6f62dd2d6f202";
    const ERROR_SIGNUP_NEWUSER_EXISTS = "a465ed09lmao35a3ab9c6f01dd2d6f703";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "g986ed18ccao85a3cb9v6f01dd286f984";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "g986ed18aaao95a3cb9v6f01dd286f989";
    const ERROR_LOGIN_AUTHENTICATE = "vb806ed18bbao05a3cb9v87f01dd286f471";

    private $errorList = [];

    public function __construct()
    {
        $this->errorList = [
          ErrorMessages::PRUEBA => 'Este es un ejemplo de un mensaje de Error',
          ErrorMessages::ERROR_SIGNUP_NEWUSER => 'Hubo un error al intentar la solicitud',
          ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY => 'Llena los campos de usuario y password',
          ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS => 'Ya existe ese nombre de usuario, escoge otro',
          ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'Llena los campos de usuario y password',
          ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA => 'Nombre de usuario y/o password incorrecto',
          ErrorMessages::ERROR_LOGIN_AUTHENTICATE => 'No se puede procesar la solicitud. Ingresa usuario y password'
        ];
    }

    public function get($hash){
      return $this->errorList[$hash];
    }

    public function existsKey($key){
      if(array_key_exists($key, $this->errorList)){
        return true;
      }else{
        return false;
      }
    }
}
?>