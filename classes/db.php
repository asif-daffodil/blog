<?php

namespace classes\db;

class db
{
    public const host = "localhost";
    public const user = "root";
    public const password = "";
    public const dbName = "cmbd234";
    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this::host, $this::user, $this::password, $this::dbName);
    }

    public function __destruct()
    {
        unset($this->conn);
    }

    public function sanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
