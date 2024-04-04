<?php
class db
{
    private const host = "localhost";
    private const user = "root";
    private const password = "";
    private const dbName = "cmbd234";
    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this::host, $this::user, $this::password, $this::dbName);
    }

    public function __destruct()
    {
        unset($this->conn);
    }
}
