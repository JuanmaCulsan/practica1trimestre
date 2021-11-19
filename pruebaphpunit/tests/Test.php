<?php //declare(strict_types=1);

use PHPUnit\Framework\TestCase;

//use RegistrarUsuarios;

//require '../practica1trimestre/funciones/multiplicacion.php';

class Test extends TestCase{

    public function comprobar() : void{
        require '../practica1trimestre/funciones/multiplicacion.php';
        $this->assertIsArray(numeritos(5,6));

    }
}

