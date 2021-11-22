<?php
// Loading up TestCase
use PHPUnit\Framework\TestCase;

require "../../funciones/sujetodePruebas/TESTpassword.php";

class Test3 extends TestCase{

    public function testOneDatatypePasswordGivesScoreOf1(){
        $pass = new Password("Foopassword");
        $strength = $pass->get_strength();

        $this->assertEquals(1, $strength, "Comprueba que nivel de seguridad es 1 porque solo tiene letras la pasword");

        $pass = new Password("123123123");
        $strength = $pass->get_strength();

        $this->assertEquals(1, $strength, "Comprueba que nivel de seguridad es 1 porque solo tiene números la pasword");
    }
    public function testTwoDatatypePasswordGivesScoreOf2(){
        $pass = new Password("Foobar123");
        $strength = $pass->get_strength();

        $this->assertEquals(2, $strength,"Comprueba que nivel de seguridad es 2 porque tiene letras y números la pasword");
    }
    public function testTwoDatatypePasswordGivesScoreOf0(){
        $pass = new Password("#!#!#!!#!#!");
        $strength = $pass->get_strength();

        $this->assertEquals(0, $strength,"Comprueba que nivel de seguridad es 0 porque no tiene letras y números la pasword");
    }


    public function testScoreOf0ThrowsException()
    {
        $this->expectException(InvalidPasswordException::class);
        $pass = new Password("#!#!#!!#!#!");
        $pass->validate();
    }
    public function testPasswordLengthLessThan8ThrowsException()
    {
        $this->expectException(InvalidPasswordException::class);
        $pass = new Password("foo");
        $pass->validate();
    }
}