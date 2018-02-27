<?php

class Db {
    protected $connection;

    public function __construct($host, $user, $password, $dbName) {
        $this->connection = new mysqli($host, $user, $password, $dbName);
        $this->connection->set_charset("utf8");
        if (mysqli_connect_errno()) {
            throw new Exception("Could not connect database");
        }
    }

    public function query($sql) {
        if (!$this->connection) {
            return false;
        }
        $result = $this->connection->query($sql);
        if (mysqli_error($this->connection)) {
            throw new Exception(mysqli_error($this->connection));
        }

        if (is_bool($result)) {
            return $result;
        }

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function escape($str) {
        return $this->connection->escape_string($str);
    }
}