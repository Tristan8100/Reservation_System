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

        public function updatepasswordDB($pass, $id){
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

        public function updatepic($im, $id){
            $sql = "UPDATE user SET user_image = :im WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':im', $im, PDO::PARAM_LOB);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updateinfoDB($fn, $un, $id){
            $sql = "UPDATE user SET user_fullname = :fn, user_number = :un WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':fn', $fn);
            $stmt->bindParam(':un', $un);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }

    class therapistmodel extends DB{

        public function getonetherapist($id){
            $sql = 'SELECT * FROM therapist WHERE therapist_ID = :id';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id',  $id);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getall(){
            $sql = 'SELECT * FROM therapist';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function addtherapist($tf, $te, $tg, $tn){
            $sql = "INSERT INTO therapist (therapist_fullname, therapist_email, therapist_gender, therapist_number) VALUES (:tf, :te, :tg, :tn)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':tf', $tf);
            $stmt->bindParam(':te', $te);
            $stmt->bindParam(':tg', $tg);
            $stmt->bindParam(':tn', $tn);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function therapistcount(){
            $sql = "SELECT COUNT(*) AS total_rows FROM therapist";
            $stmt = $this->connect()->prepare($sql);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function allactive(){
            $sql = 'SELECT * FROM therapist WHERE therapist_status = "ACTIVE"';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function allinactive(){
            $sql = 'SELECT * FROM therapist WHERE therapist_status = "INACTIVE"';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function markasinactive($id){
            $sql = "UPDATE therapist SET therapist_status = 'INACTIVE' WHERE therapist_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updatetherapist($tf, $te, $tg, $tn, $id){
            $sql = "UPDATE therapist SET therapist_fullname = :tf, therapist_email = :te, therapist_gender = :tg, therapist_number = :tn WHERE therapist_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':tf', $tf);
            $stmt->bindParam(':te', $te);
            $stmt->bindParam(':tg', $tg);
            $stmt->bindParam(':tn', $tn);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }




    class categorymodel extends DB {


        public function getallcategory(){
            $sql = 'SELECT * FROM category WHERE category_status = "ACTIVE"';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function checkcategory($cp){
            $sql = 'SELECT * FROM category WHERE category_prefix = :cp';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':cp', $cp);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function addcategory($cm, $cp){
            $sql = "INSERT INTO category (category_name, category_prefix) VALUES (:cm, :cp)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':cm', $cm);
            $stmt->bindParam(':cp', $cp);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function categorycount(){
            $sql = "SELECT COUNT(*) AS total_rows FROM category";
            $stmt = $this->connect()->prepare($sql);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function updatecategory($cn, $cp, $id){
            $sql = "UPDATE category SET category_name = :cn, category_prefix = :cp WHERE category_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':cn', $cn);
            $stmt->bindParam(':cp', $cp);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function checkcategory2($cp, $id){
            $sql = 'SELECT * FROM category WHERE category_prefix = :cp AND category_ID != :id';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':cp', $cp);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getonecategory($id){
            $sql = 'SELECT * FROM category WHERE category_ID = :id';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }



    }



    class servicemodel extends DB {


        public function getallservice(){
            $sql = 'SELECT * FROM `service`';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getoneservice($id){
            $sql = 'SELECT * FROM `service` WHERE service_ID = :id';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function addservice($id, $cidfk, $sn, $si, $sdesc, $sp, $sdur){
            $sql = "INSERT INTO `service` (service_ID, category_IDFK, `service_name`, service_image, service_description, service_price, service_duration ) VALUES (:id, :cidfk, :sn, :si, :sdesc, :sp, :sdur)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':cidfk', $cidfk);
            $stmt->bindParam(':sn', $sn);
            $stmt->bindParam(':si', $si, PDO::PARAM_LOB);
            $stmt->bindParam(':sdesc', $sdesc);
            $stmt->bindParam(':sp', $sp);
            $stmt->bindParam(':sdur', $sdur);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function editservicewithimage($sn, $cidfk, $sm, $sdesc, $sp, $sdur, $id){
            $sql = "UPDATE `service` SET `service_name` = :sn, category_IDFK = :cidfk, service_image = :sm, service_description = :sdesc, service_price = :sp, service_duration = :sdur WHERE service_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':sn', $sn);
            $stmt->bindParam(':cidfk', $cidfk);
            $stmt->bindParam(':sm', $sm);
            $stmt->bindParam(':sdesc', $sdesc);
            $stmt->bindParam(':sp', $sp);
            $stmt->bindParam(':sdur', $sdur);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function editservicenoimage($sn, $cidfk, $sdesc, $sp, $sdur, $id){
            $sql = "UPDATE `service` SET `service_name` = :sn, category_IDFK = :cidfk, service_description = :sdesc, service_price = :sp, service_duration = :sdur WHERE service_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':sn', $sn);
            $stmt->bindParam(':cidfk', $cidfk);
            $stmt->bindParam(':sdesc', $sdesc);
            $stmt->bindParam(':sp', $sp);
            $stmt->bindParam(':sdur', $sdur);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


    }

?>