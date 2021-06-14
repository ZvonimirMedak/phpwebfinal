<?php

class Database
{
    private $host = "eu-cdbr-west-03.cleardb.net";
    //private $db_name = "beb94c6723d2db";
    private $username = "beb94c6723d2db";
    private $password = "986f14f0";
    public $db_conn;
    mysql://beb94c6723d2db:986f14f0@eu-cdbr-west-01.cleardb.com/heroku_6b701f9298db012?reconnect=true

    // get the database connection
    public function getConnection()
    {
        $this->db_conn = null;

        try {
            $this->db_conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Database Connection Error: " . $exception->getMessage();
        }
        return $this->db_conn;
    }
}