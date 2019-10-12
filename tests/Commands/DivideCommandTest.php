<?php

namespace Tests;

use Jakmall\Recruitment\Calculator\Commands\DivideCommand;
use Tests\ParentTester;

final class DivideCommandTest extends ParentTester
{

    protected function setUp()
    {
        ParentTester::build(DivideCommand::class,"divide");
    }

    public function testTwoSameNumber(): void
    {   
        $this->assertEquals('1 / 1 = 1',$this->rawCommand(array('numbers' => array(1,1))));
        $this->assertEquals('10 / 10 = 1',$this->rawCommand(array('numbers' => array(10,10))));
    }

    public function testTwoDifferentNumber(): void
    {   
        $this->assertEquals('5 / 1 = 5',$this->rawCommand(array('numbers' => array(5,1))));
        $this->assertEquals('100 / 10 = 10',$this->rawCommand(array('numbers' => array(100,10))));
    }

    public function testNegativeNumber(): void
    {   
        $this->assertEquals('-5 / 1 = -5',$this->rawCommand(array('numbers' => array(-5,1))));
        $this->assertEquals('22 / -2 = -11',$this->rawCommand(array('numbers' => array(22,-2))));
    }

    public function testSequenceNumbers(): void
    {   
        $this->assertEquals('15 / 5 / 2 / 3 = 0.5',$this->rawCommand(array('numbers' => array(15,5,2,3))));
        $this->assertEquals('47 / 11 / 12 / 13 / 1 = 0.027',$this->rawCommand(array('numbers' => array(47,11,12,13,1))));
    }

    public function testEmptyNumber(): void
    {   
        $this->assertEquals('Argument needed',$this->rawCommand(array('numbers' => array())));
    }

    public function testSingleNumber(): void
    {   
        $this->assertEquals('1 = 1',$this->rawCommand(array('numbers' => array(1))));
    }


}