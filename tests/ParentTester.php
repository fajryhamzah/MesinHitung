<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Console\Tester\CommandTester;

class ParentTester extends TestCase
{
    protected $commandTester;
    protected $command;

    protected function build($obj, $command)
    {
        $container = new Container();
        $dispatcher = new Dispatcher();
        $application = new Application($container, $dispatcher, '0.1');
        $obj = new $obj;
        $obj->log_command = false;
        $application->setName('Calculator');
        $application->add($obj);
        $this->command = $application->find($command);
        $this->commandTester = new CommandTester($this->command);   
    }

    protected function getCommandName(): string
    {   
        return $this->command->getName();
    }

    public function rawCommand(array $cmd){
        $command = array(
            'command' => $this->getCommandName()
        );
        $command = array_merge($command,$cmd);
        
        $this->commandTester->execute($command);

        return str_replace("\n","",$this->commandTester->getDisplay());
    }



}