<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Logger;
use Illuminate\Console\Command;

abstract class ParentCommand extends Command
{
    /**
     * @var string
     */
    protected $signature;

    /**
     * @var string
     */
    protected $description;
    
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

    /**
     * @var array
     */
    protected $input_arg;

    /**
     * @var bool
     */
    protected $log_command = true;

    public function __construct()
    {
        
        $commandVerb = $this->getCommandVerb();

        if(!$this->signature)
            $this->signature = sprintf(
                '%s {numbers* : The numbers to be %s}',
                $commandVerb,
                $this->getCommandPassiveVerb()
            );

        if(!$this->description)
            $this->description = sprintf('%s all given Numbers', ucfirst($commandVerb));
        
        parent::__construct();
    }

    protected function addSignature($args,$detail):void
    {
        $signature = sprintf("{%s : %s}",$args,$detail);

        if($this->signature){
            $this->signature = $this->signature." ".$signature;
        }
        else{
            $this->signature = sprintf("%s %s",$this->getCommandVerb(),$signature);
        }
    }

    protected function getCommandVerb(): string
    {
        return $this->command_verb;
    }

    protected function getCommandPassiveVerb(): string
    {
        return $this->passive_verb;
    }

    public function handle(): void
    {
        $numbers = $this->getInput();

        if(count($numbers) < 1){
            $this->comment(sprintf('Argument needed'));
            return;
        }

        $description = $this->generateCalculationDescription($numbers);
        $result = $this->calculateAll($numbers);
        $output = sprintf('%s = %s', $description, $result);

        if($this->log_command){
            Logger::writeLog(array(
                "command" => ucfirst($this->getCommandVerb()),
                "description" => $description,
                "result" => $result,
                "output" => $output
            ));
        }

        $this->comment($output);
    }


    protected function getInput(): array
    {
        if(!empty($this->input_arg)){
            $input = array();
            foreach($this->input_arg as $arg){
                $input[] = $this->argument($arg);
            }

            return $input;
        }

        return $this->argument("numbers");
    }

    protected function generateCalculationDescription(array $numbers): string
    {
        $operator = $this->getOperator();
        $glue = sprintf(' %s ', $operator);

        return implode($glue, $numbers);
    }

    protected function getOperator(): string
    {
        return $this->operator;
    }

    protected function calculateAll(array $numbers){
        $sum = array_shift($numbers);

        foreach($numbers as $number){
            $sum = $this->calculate($sum,$number);
        }

        return $sum;
    }
    
}
