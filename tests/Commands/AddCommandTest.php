<?php

namespace Tests;

use Jakmall\Recruitment\Calculator\Commands\AddCommand;
use Tests\ParentTester;

final class AddCommandTest extends ParentTester
{

    protected function setUp()
    {
        ParentTester::build(AddCommand::class,"add");
    }

    public function testTwoSameNumber(): void
    {   
        $this->assertEquals('1 + 1 = 2',$this->rawCommand(array('numbers' => array(1,1))));
        $this->assertEquals('10 + 10 = 20',$this->rawCommand(array('numbers' => array(10,10))));
    }

    public function testTwoDifferentNumber(): void
    {   
        $this->assertEquals('1 + 5 = 6',$this->rawCommand(array('numbers' => array(1,5))));
        $this->assertEquals('10 + 11 = 21',$this->rawCommand(array('numbers' => array(10,11))));
    }

    public function testNegativeNumber(): void
    {   
        $this->assertEquals('-1 + 5 = 4',$this->rawCommand(array('numbers' => array(-1,5))));
        $this->assertEquals('21 + -11 = 10',$this->rawCommand(array('numbers' => array(21,-11))));
    }

    public function testSequenceNumbers(): void
    {   
        $this->assertEquals('1 + 5 + 2 + 3 = 11',$this->rawCommand(array('numbers' => array(1,5,2,3))));
        $this->assertEquals('10 + 11 + 12 + 13 + 1 = 47',$this->rawCommand(array('numbers' => array(10,11,12,13,1))));
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