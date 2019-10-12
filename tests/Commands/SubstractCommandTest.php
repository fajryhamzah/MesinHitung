<?php

namespace Tests;

use Jakmall\Recruitment\Calculator\Commands\SubstractCommand;
use Tests\ParentTester;

final class SubstractCommandTest extends ParentTester
{

    protected function setUp()
    {
        ParentTester::build(AddCommand::class,"add");
    }

    public function testTwoSameNumber(): void
    {   
        $this->assertEquals('1 - 1 = 0',$this->rawCommand(array('numbers' => array(1,1))));
        $this->assertEquals('10 - 10 = 0',$this->rawCommand(array('numbers' => array(10,10))));
    }

    public function testTwoDifferentNumber(): void
    {   
        $this->assertEquals('5 - 1 = 4',$this->rawCommand(array('numbers' => array(5,1))));
        $this->assertEquals('11 - 10 = 1',$this->rawCommand(array('numbers' => array(11,10))));
    }

    public function testNegativeNumber(): void
    {   
        $this->assertEquals('-1 - 5 = -5',$this->rawCommand(array('numbers' => array(-1,5))));
        $this->assertEquals('21 - -11 = 32',$this->rawCommand(array('numbers' => array(21,-11))));
    }

    public function testSequenceNumbers(): void
    {   
        $this->assertEquals('15 - 5 - 2 - 3 = 5',$this->rawCommand(array('numbers' => array(15,5,2,3))));
        $this->assertEquals('47 - 11 - 12 - 13 - 1 = 10',$this->rawCommand(array('numbers' => array(47,11,12,13,1))));
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