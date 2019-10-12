<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\ParentCommand;

class DivideCommand extends ParentCommand
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
        
        $this->operator = '/';
        $this->command_verb = 'divide';
        $this->passive_verb = 'divided';

        parent::__construct();
    }

    public function calculate($number1, $number2)
    {
        return round($number1 / $number2,3);
    }
}
