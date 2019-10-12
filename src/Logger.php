<?php
namespace Jakmall\Recruitment\Calculator;

class Logger{
    protected static $filename = './app.log';

    public function writeLog(array $data): void{
        $data = array_merge($data, array("time" => date("Y-m-d H:i:s")));

        file_put_contents(self::$filename,json_encode($data)."\n",FILE_APPEND);
    }

    public function readLog(){

    }

}