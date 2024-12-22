<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_log 
{

    function __construct() 
    {
    }


    function logQueries() 
    {
        $CI = & get_instance();

        $filepath = APPPATH . 'logs/IQuery-log-' . date('Y-m-d') . '.php'; 
        $handle = fopen($filepath, "a+");
        
        $jilepath = APPPATH . 'logs/DQuery-log-' . date('Y-m-d') . '.php'; 
        $jandle = fopen($jilepath, "a+"); 
        
        $kilepath = APPPATH . 'logs/UQuery-log-' . date('Y-m-d') . '.php'; 
        $kandle = fopen($kilepath, "a+"); 

        $times = $CI->db->query_times;
        foreach ($CI->db->queries as $key => $query) 
        { 
            if($query[0] == 'I' or $query[0] == 'i'){
                $sql = $query . " \n Execution Time:" . $times[$key]."\n Date: ".date('m/d/Y h:i:s a', time()); 

                fwrite($handle, $sql . "\n\n");    
            }
            else if($query[0] == 'U' or $query[0] == 'u'){
                $sql = $query . " \n Execution Time:" . $times[$key]."\n Date: ".date('m/d/Y h:i:s a', time()); 

                fwrite($kandle, $sql . "\n\n");    
            }
            else if($query[0] == 'd' or $query[0] == 'D'){
                $sql = $query . " \n Execution Time:" . $times[$key]."\n Date: ".date('m/d/Y h:i:s a', time()); 

                fwrite($jandle, $sql . "\n\n");    
            }
                // $sql = $query . " \n Execution Time:" . $times[$key]."\n Date: ".date('m/d/Y h:i:s a', time()); 

                // fwrite($handle, $sql . "\n\n");   
        }

        fclose($handle);
        fclose($jandle);
        fclose($kandle);
    }

}