<?php

namespace Jakmall\Recruitment\Calculator\Commands\History;

use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Logger;

class HistoryClearCommand extends Command
{
    public function __construct()
    {
        
        $this->signature = "history:clear";
        $this->description = "Clear saved history";

        parent::__construct();
    }

    public function handle(){
        Logger::clearLog();
        $this->comment("History cleared.");
    }

}
