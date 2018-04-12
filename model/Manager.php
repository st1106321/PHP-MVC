<?php

/*
** Manager classe contains connection to database and query validation
*/

class Manager {

    private $connect;

    /* Connect to database using default values */
    protected function setConnection($servername = "127.0.0.1:50426", $username = "azure", $password = "6#vWHD_$", $dbname = "localdb") {        
    // protected function setConnection($servername = "localhost", $username = "user1", $password = "user1", $dbname = "php-db"){
    // protected function setConnection($servername = "localhost", $username = "user2", $password = "", $dbname = "php-db2"){
        $this->connect = new mysqli($servername, $username, $password, $dbname);
        if ($this->connect->connect_error) {
            throw new Exception("Connection failed: {$this->$connect->connect_error}");
        }
    }

    /* Test the query, throw an error if mysqli return a wrong value */
    protected function isQueryOK($sql, $errorMsg) {
        $this->setConnection();
        $ret = $this->connect->query($sql);
        $this->connect->close();
        if (!$ret) {
            throw new Exception($errorMsg);
        }
        return $ret;        
    }

    protected function preparedInjection($sql, $values, $errorMsg) {
        $this->setConnection();
                
    }

}