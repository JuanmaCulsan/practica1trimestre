<?php //declare(strict_types=1);

use PHPUnit\Framework\TestCase;

//use RegistrarUsuarios;

require '../../funciones/sujetodePruebas/multiplicacion.php';

class Test extends TestCase{

    public function test_numeritos() : void{
        //require '../practica1trimestre/funciones/multiplicacion.php';
        $op1 = 5;
        $op2 = 6;
        $resutl = numeritos($op1,$op2);

        $valores = [11,-1,30];

        $this->assertIsArray($resutl,"Prueba numeritos(5,5) comprueba que devuelve un array");
        $this->assertSame($valores[0], $op1+$op2, "Prueba numeritos, suma correctamente");
  
        $this->assertIsInt(numeritos($op1,$op2)," Prueba numeritos, si ambos son int");
    }

}

