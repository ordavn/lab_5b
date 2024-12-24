<?php
class Database
{
    private $host = "localhost";
    private $db_name = "lab_5b";
    private $username = "palapa";
    private $password = "testing123";
    public $conn;

    public function getConnection()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            // "Connection Successfully";
        }

        return $this->conn;
    }
}