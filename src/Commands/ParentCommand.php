<?php

namespace Jakmall\Recruitment\Calculator\Commands;

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

    public function __construct()
    {
        
        $commandVerb = $this->getCommandVerb();

        $this->signature = sprintf(
            '%s {numbers* : The numbers to be %s}',
            $commandVerb,
            $this->getCommandPassiveVerb()
        );
        $this->description = sprintf('%s all given Numbers', ucfirst($commandVerb));
        parent::__construct();
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

        $this->comment(sprintf('%s = %s', $description, $result));
    }

    protected function getInput(): array
    {
        return $this->argument('numbers');
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
        $sum = 0;

        foreach($numbers as $number){
            $sum = $this->calculate($sum,$number);
        }

        return $sum;
    }
    
}
