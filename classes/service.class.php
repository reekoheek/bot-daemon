<?php

/*
 * service.class.php
 *
 * Created on 01/07/2011 20:29:32
 *
 * Copyright(c) 2011 PT Sagara Xinix Solusitama.  All Rights Reserved.
 * This software is the proprietary information of PT Sagara Xinix Solusitama.
 *
 * History
 * =======
 * (dd/mm/yyyy hh:mm) (name)
 * 01/07/2011 20:29   jafar
 *
 */

/**
 * Description of service
 *
 * @author jafar
 */
class Service {

    var $host;
    var $user;
    var $pass;
    var $db;

    function __construct($config) {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
    }

    function request($request) {
        return $request;
    }

    function run() {
        while (1) {
            $this->link = mysql_connect($this->host, $this->user, $this->pass);
            mysql_select_db($this->db, $this->link);

            $result = mysql_query('SELECT * FROM inbox', $this->link);
            while ($row = mysql_fetch_array($result)) {
                $response = $this->request($row['body']);
                if (!is_array($response)) {
                    $response = array($response);
                }
                foreach ($response as $line) {
                    mysql_query("INSERT INTO outbox VALUES('" . mysql_escape_string($row['account']) . "','" . mysql_escape_string($row['from']) . "','" . mysql_escape_string($line) . "', NOW())");
                }
            }
            mysql_query("TRUNCATE TABLE inbox");
            sleep(1);
        }
        mysql_close($this->link);
    }

}

?>
