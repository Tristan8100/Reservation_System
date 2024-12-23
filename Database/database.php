<?php

    class DB {
        private $host = 'localhost';
        private $db = 'reservation_system';
        private $user = 'root';
        private $pass = '';
        private $conn;

        public function connect(){
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }

?>