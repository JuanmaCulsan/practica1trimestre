<?php //declare(strict_types=1);

use PHPUnit\Framework\TestCase;

//use RegistrarUsuarios;

require '../../funciones/sujetodePruebas/multiplicacion.php';

class Test2 extends TestCase{

    public function test_multiplicacion() : void{
        $nombre= "Juanma";
        $apellidos="Culsan Rondon";

        $this->assertIsString(nombre($nombre, $apellidos),"comprobar si devuelve una cadena");      
    }
}
