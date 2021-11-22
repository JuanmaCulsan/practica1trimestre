<?php
class Password {
    protected $password = "";
    function __construct($password = "")
    {
        $this->password = $password;
    }
    public function validate(){
        if(strlen($this->password) < 8){
            throw new InvalidPasswordException();
        }
        if($this->get_strength() == 0){
            throw new InvalidPasswordException();
        }
    }
    public function get_strength(){
        $strength = 0;
        if(preg_match('/[A-Za-z]/', $this->password)){
            // Letra encontrada
            $strength +=1;
        }
        if(preg_match('/[0-9]/', $this->password)){
            // Digito encontrado
            $strength += 1;
        }
        return $strength;
    }
}
class InvalidPasswordException extends Exception{
    public function errorMessage()
    {
       //error message
       $errorMsg = 'Contraseña no válida. Por favor comprueba que la longitud de la contraseña sea de más de 8 caracteres y contiene caracteres alfanuméricos.';
       return $errorMsg;
    }
}