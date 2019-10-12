<?php
namespace Jakmall\Recruitment\Calculator;

class Logger{
    protected static $filename = './app.log';

    public function writeLog(array $data): void
    {
        $data = array_merge($data, array("time" => date("Y-m-d H:i:s")));

        file_put_contents(self::$filename,json_encode($data)."\n",FILE_APPEND);
    }

    public function readLog(array $filter = array()): array
    {
        $data = array();
    
        $handler = fopen(self::$filename,"r");
        
        if($handler){
            $no = 1;
            while(($line = fgets($handler)) !== false){
                $log = json_decode($line,true);
                
                if( (empty($filter)) || 
                    (in_array(strtolower($log["command"]),$filter))
                  )
                {
                    
                    $data[] = array_merge([$no],$log);
                    $no++;
                }
            }

            fclose($handler);

        }

        return $data;
    }

    public function clearLog(): void
    {
        $handle = fopen(self::$filename,'w');
        fclose($handle);
    }


}