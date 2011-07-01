#!/usr/bin/php
<?php

require_once './classes/service.class.php';


class TranslateService extends Service {


    function request($request) {
        
        $json = file_get_contents("https://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".rawurlencode($request)."&langpair=id%7Cen");
        $data = json_decode($json);
//        print_r($data->responseData->translatedText);
        
        return $data->responseData->translatedText;
    }

}

$config = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => 'password',
    'db'   => 'chat_gw',
);

$service = new TranslateService($config);
$service->run();

//while (1) {


    
//    sleep(1);
//}