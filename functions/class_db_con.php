<?php

class class_db_con {

    public function connect_db($host, $name, $user, $pass) {
        try {
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $name, $user, $pass);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

}
