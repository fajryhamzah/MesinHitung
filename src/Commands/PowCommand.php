<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\ParentCommand;

class PowCommand extends ParentCommand
{
    /**
     * @var string
     */
    protected $operator;

    /**
     * @var string
     */
    protected $command_verb;

    /**
     * @var string
     */
    protected $passive_verb;

    public function __construct()
    {
        
        $this->operator = '^';
        $this->command_verb = 'pow';
        $this->passive_verb = 'exponent';
        $this->description = sprintf('%s all given Numbers', ucfirst($this->passive_verb));
        $this->addSignature("base","The base number");
        $this->addSignature("exp","The exponent number");
        $this->input_arg = array("base","exp");

        parent::__construct();
    }

    public function calculate($number1, $number2)
    {
        return round(pow($number1,$number2),3);
    }
}
