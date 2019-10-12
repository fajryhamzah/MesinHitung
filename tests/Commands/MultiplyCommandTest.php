<?php

namespace Tests;

use Jakmall\Recruitment\Calculator\Commands\MultiplyCommand;
use Tests\ParentTester;

final class MultiplyCommandTest extends ParentTester
{

    protected function setUp()
    {
        ParentTester::build(MultiplyCommand::class,"multiply");
    }

    public function testTwoSameNumber(): void
    {   
        $this->assertEquals('1 * 1 = 1',$this->rawCommand(array('numbers' => array(1,1))));
        $this->assertEquals('10 * 10 = 100',$this->rawCommand(array('numbers' => array(10,10))));
    }

    public function testTwoDifferentNumber(): void
    {   
        $this->assertEquals('5 * 1 = 5',$this->rawCommand(array('numbers' => array(5,1))));
        $this->assertEquals('11 * 10 = 110',$this->rawCommand(array('numbers' => array(11,10))));
    }

    public function testNegativeNumber(): void
    {   
        $this->assertEquals('-1 * 5 = -5',$this->rawCommand(array('numbers' => array(-1,5))));
        $this->assertEquals('21 * -2 = -42',$this->rawCommand(array('numbers' => array(21,-2))));
    }

    public function testSequenceNumbers(): void
    {   
        $this->assertEquals('15 * 5 * 2 * 3 = 450',$this->rawCommand(array('numbers' => array(15,5,2,3))));
        $this->assertEquals('47 * 11 * 12 * 13 * 1 = 80652',$this->rawCommand(array('numbers' => array(47,11,12,13,1))));
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