<?php

    include "Database/database.php";

    class usermodel extends DB{
        

        public function loginselect($em){
            $sql = 'SELECT * FROM user WHERE user_email = :em';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':em',  $em);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result : 'NO USER';
            } else {
                return false;
            }
        }

        public function createaccount($uf, $us, $up, $rol){
            $sql = "INSERT INTO user (user_fullname, user_email, user_password, user_role) VALUES (:uf, :us, :up, :rol)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':uf', $uf);
            $stmt->bindParam(':us', $us);
            $stmt->bindParam(':up', $up);
            $stmt->bindParam(':rol', $rol);
            if ($stmt->execute()) {
                return $this->loginselect($us);
            } else {
                return false;
            }
        }

        public function insertcode($code, $id){
            $sql = "UPDATE user SET user_code = :code WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function selectcode($code){
            $sql = 'SELECT * FROM user WHERE user_code = :code';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':code',  $code);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result : false;
            } else {
                return false;
            }
        }

        public function updatestatus($id){
            $sql = "UPDATE user SET user_status = :stat WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(':stat', "REGISTERED");
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return $this->deletecode($id);
            } else {
                return false;
            }
        }

        public function deletecode($id){
            $sql = "UPDATE user SET user_code = :code WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(':code', NULL, PDO::PARAM_NULL);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function selectuser($id){
            $sql = 'SELECT * FROM user WHERE user_ID = :id';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id',  $id);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result : 'NOT FOUND';
            } else {
                return false;
            }
        }

        public function updatepassword($pass, $id){
            $sql = "UPDATE user SET user_password = :pass WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }

?>