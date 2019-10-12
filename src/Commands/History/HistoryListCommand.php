<?php

namespace Jakmall\Recruitment\Calculator\Commands\History;

use Jakmall\Recruitment\Calculator\Logger;
use Illuminate\Console\Command;

class HistoryListCommand extends Command
{
    public function __construct()
    {
        
        $this->signature = "history:list {commands?* : Filter the history by commands}";
        
        $this->description = "Show calculator history";
        parent::__construct();
    }

    public function handle(){
        $cmd = $this->argument("commands");
        
        if(!$cmd) $cmd = array();

        $log = Logger::readLog($cmd);

        if(empty($log)){
            $this->comment("History is empty.");
        }
        else{
            $headers = ["No","Command","Description","Result","Output","Time"];
    
            $this->table($headers,$log);
        }

    }

}
