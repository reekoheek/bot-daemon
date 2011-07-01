#!/usr/bin/php
<?php

require_once './classes/service.class.php';


class System_check_service extends Service {


    function request($request) {
        $output = '';
        exec($request, $output);
        return $output;
    }

}

$config = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => 'password',
    'db'   => 'chat_gw',
);

$service = new System_check_service($config);

//$result = $service->request('ls');
//print_r($result);

$service->run();



//while (1) {


    
//    sleep(1);
//}