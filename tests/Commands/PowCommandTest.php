<?php

namespace Tests;

use Jakmall\Recruitment\Calculator\Commands\PowCommand;
use Tests\ParentTester;

final class PowCommandTest extends ParentTester
{

    protected function setUp()
    {
        ParentTester::build(PowCommand::class,"pow");
    }

    public function testTwoSameNumber(): void
    {   
        $this->assertEquals('1 ^ 1 = 1',$this->rawCommand(array('base' => 1,'exp'=>1)));       
        $this->assertEquals('2 ^ 2 = 4',$this->rawCommand(array('base' => 2,'exp'=>2)));       
    }

    public function testTwoSamedifferentNumber(): void
    {   
        $this->assertEquals('3 ^ 5 = 243',$this->rawCommand(array('base' => 3,'exp'=>5)));       
        $this->assertEquals('2 ^ 10 = 1024',$this->rawCommand(array('base' => 2,'exp'=>10)));       
    }

    public function testNegativeNumber(): void
    {   
        $this->assertEquals('3 ^ -5 = 0.004',$this->rawCommand(array('base' => 3,'exp'=>-5)));       
        $this->assertEquals('-2 ^ 10 = 1024',$this->rawCommand(array('base' => -2,'exp'=>10)));       
    }

    public function testEmptyNumber(): void
    {   
        $this->expectExceptionMessage("Not enough arguments");
        $this->rawCommand(array('base','exp'));
    }

}