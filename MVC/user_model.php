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

    }

?>