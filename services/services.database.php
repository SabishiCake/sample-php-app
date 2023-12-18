<?php

$config = parse_ini_file(__DIR__ . '/../config.ini');

class Database
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    public function __construct()
    {
        global $config;
        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->dbname = $config['dbname'];

        if ($this->port) {
            $this->conn = new mysqli($this->host . ":" . $this->port, $this->username, $this->password, $this->dbname);
        } else {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        }

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            echo "<script>console.log('Database connection successful');</script>";
        }
    }

    public function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function getCon()
    {
        return $this->conn;
    }

    // test database connection
    public function test()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>console.log('Database connection is working');</script>";
        } else {
            echo "<script>console.log('Database connection is not working');</script>";
        }
    }
}
?>