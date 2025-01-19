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

        public function usercount(){
            $sql = "SELECT COUNT(*) AS total FROM user";
            $stmt = $this->connect()->prepare($sql);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function alluser(){
            $sql = "SELECT * FROM user";
            $stmt = $this->connect()->prepare($sql);
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            $stmt->bindParam(':sm', $sm, PDO::PARAM_LOB);
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

        public function servicecount(){
            $sql = "SELECT COUNT(*) AS total_rows FROM `service` WHERE service_status = 'ACTIVE'";
            $stmt = $this->connect()->prepare($sql);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }


    }

    class reservationmodel extends DB {


        public function getallreservation(){
            $sql = 'SELECT * FROM reservation';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getallone($id){
            $sql = 'SELECT * FROM reservation WHERE reservation_ID = :id';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

    
        public function getreservationperuser($usid, $rid){
            $sql = 'SELECT * FROM reservation WHERE user_IDFK = :usid AND reservation_ID = :rid';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':usid', $usid);
            $stmt->bindParam(':rid', $rid);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function updatedurprice($price, $duration, $id){
            $sql = "UPDATE reservation SET reservation_duration = :rdur, reservation_total = :rtotal WHERE reservation_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':rdur', $duration);
            $stmt->bindParam(':rtotal', $price);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function addreservation($rid, $uidfk, $rdt, $rt, $rp, $ra, $rl, $rg, $rr, $rname){
            $sql = "INSERT INTO reservation (reservation_ID, user_IDFK, reservation_datetime, reservation_type, reservation_phone, reservation_address, reservation_landmark, reservation_gender, reservation_remarks, reservation_name) 
            VALUES (:rid, :uidfk, :rdt, :rt, :rp, :ra, :rl, :rg, :rr, :rname)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':rid', $rid);
            $stmt->bindParam(':uidfk', $uidfk);
            $stmt->bindParam(':rdt', $rdt);
            $stmt->bindParam(':rt', $rt);
            $stmt->bindParam(':rp', $rp);
            $stmt->bindParam(':ra', $ra);
            $stmt->bindParam(':rl', $rl);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':rr', $rr);
            $stmt->bindParam('rname', $rname);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function addreservationservice($ridfk, $sidfk, $uidfk, $duration, $price){
            $sql = "INSERT INTO reservation_services (reservation_IDFK, service_IDFK, user_IDFK, reservation_price, reservation_duration) VALUES (:ridfk, :sidfk, :uidfk, :rp, :rdur)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':ridfk', $ridfk);
            $stmt->bindParam(':sidfk', $sidfk);
            $stmt->bindParam(':uidfk', $uidfk);
            $stmt->bindParam(':rp', $price);
            $stmt->bindParam(':rdur', $duration);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //for fetchin reservations
        //based on user_ID
        public function getpendinguser($usid){
            $sql = 'SELECT * FROM reservation WHERE user_IDFK = :usid AND reservation_status = \'PENDING\' OR reservation_status = \'ACCEPTED\' ORDER BY reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':usid', $usid);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getnotpendinguserjoins($usid){
            $sql = 'SELECT 
            rs.reservation_duration AS rs_reservation_duration, 
            r.reservation_duration AS r_reservation_duration, 
            rs.*, r.*, s.*, us.*, tr.*
            FROM reservation r
            INNER JOIN reservation_services rs ON rs.reservation_IDFK = r.reservation_ID
            INNER JOIN `service` s ON s.service_ID = rs.service_IDFK
            INNER JOIN therapist tr ON tr.therapist_ID = r.therapist_IDFK
            INNER JOIN user us ON us.user_ID = r.user_IDFK
            WHERE us.user_ID = :usid AND 
            r.reservation_status != \'PENDING\' AND r.reservation_status != \'ACCEPTED\' ORDER BY r.reservation_datetime ASC';
            //$sql = 'SELECT * FROM reservation WHERE user_IDFK = :usid AND reservation_status != \'PENDING\' AND reservation_status != \'ACCEPTED\' ORDER BY reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':usid', $usid);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getnotpendinguser($usid){
            $sql = 'SELECT * FROM reservation WHERE user_IDFK = :usid AND reservation_status != \'PENDING\' AND reservation_status != \'ACCEPTED\' ORDER BY reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':usid', $usid);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        //based on reservation_ID

        public function getresser($id){
            $sql = 'SELECT 
            rs.reservation_duration AS rs_reservation_duration, 
            r.reservation_duration AS r_reservation_duration, 
            rs.*, r.*, s.* 
        FROM reservation_services rs
        INNER JOIN reservation r ON r.reservation_ID = rs.reservation_IDFK
        INNER JOIN service s ON s.service_ID = rs.service_IDFK
        WHERE r.reservation_ID = :id';

            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function cancelreserve($id){
            $sql = "UPDATE reservation SET reservation_status = 'CANCELLED' WHERE reservation_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function cancelbyadmin($id){
            $sql = "UPDATE reservation SET reservation_status = 'CANCELLED BY ADMIN' WHERE reservation_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function accept($id, $tid, $re){
            $sql = "UPDATE reservation SET reservation_status = 'ACCEPTED', therapist_IDFK = :tid, reservation_ends = :re WHERE reservation_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':tid', $tid);
            $stmt->bindParam(':re', $re);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function reschedule($id){
            $sql = "UPDATE reservation SET reservation_status = 'RESCHEDULE' WHERE reservation_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function countpending(){
            $sql = 'SELECT COUNT(*) AS total FROM reservation WHERE reservation_status = \'PENDING\'';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function countuntracked(){
            $sql = 'SELECT COUNT(*) AS total FROM reservation WHERE reservation_status = \'ACCEPTED\' AND reservation_datetime < NOW() ';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function counttoday(){
            $sql = 'SELECT COUNT(*) AS total FROM reservation WHERE reservation_status = \'ACCEPTED\' AND DATE(reservation_datetime) = CURDATE()';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function alluntracked(){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE r.reservation_status = \'ACCEPTED\' AND r.reservation_datetime < NOW() ORDER BY r.reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchALL(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function oneuntracked($rid){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE r.reservation_status = \'ACCEPTED\' AND r.reservation_ID = :rid ORDER BY r.reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':rid', $rid);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getpendingall(){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE reservation_status = \'PENDING\' ORDER BY reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getpendinguserindividual($rid){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE reservation_status = \'PENDING\' AND reservation_ID = :rid';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':rid', $rid);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function totrack($id, $rs){
            $sql = "UPDATE reservation SET reservation_status = :rs WHERE reservation_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':rs', $rs);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function tracked(){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE r.reservation_status != \'PENDING\' AND r.reservation_status != \'ACCEPTED\' ORDER BY r.reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getstatus($statuss){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE r.reservation_status = :statuss ORDER BY r.reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':statuss', $statuss);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        //based on date and status
        public function getdate($datee){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE DATE (r.reservation_datetime) = :datee ORDER BY r.reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':datee', $datee);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getdateandstatus($datee, $statuss){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE DATE (r.reservation_datetime) = :datee AND r.reservation_status = :statuss ORDER BY r.reservation_datetime ASC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':datee', $datee);
            $stmt->bindParam(':statuss', $statuss);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function gettrackedindividual($rid){
            $sql = 'SELECT r.*, us.* FROM reservation r INNER JOIN user us ON us.user_ID = r.user_IDFK WHERE r.reservation_status != \'PENDING\' AND r.reservation_status != \'ACCEPTED\' AND r.reservation_ID = :rid';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':rid', $rid);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        //based on therapist
        public function getbookedtherapist(){
            $sql = "SELECT r.*, us.*, t.*
            FROM reservation r
            INNER JOIN user us ON us.user_ID = r.user_IDFK
            INNER JOIN therapist t ON t.therapist_ID = r.therapist_IDFK
            WHERE r.reservation_status = 'ACCEPTED' ORDER BY r.reservation_datetime ASC
            ";
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getbookedtherapistbydate($dt){
            $sql = "SELECT r.*, us.*, t.*
            FROM reservation r
            INNER JOIN user us ON us.user_ID = r.user_IDFK
            INNER JOIN therapist t ON t.therapist_ID = r.therapist_IDFK
            WHERE r.reservation_status = 'ACCEPTED' AND DATE(r.reservation_datetime) = :dt ORDER BY r.reservation_datetime ASC
            ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':dt', $dt);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getaccepttherapist($tid){
            $sql = "SELECT r.*, us.*, t.*
            FROM reservation r
            INNER JOIN user us ON us.user_ID = r.user_IDFK
            INNER JOIN therapist t ON t.therapist_ID = r.therapist_IDFK
            WHERE r.reservation_status = 'ACCEPTED' AND t.therapist_ID = :tid ORDER BY r.reservation_datetime ASC
            ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':tid', $tid);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getdonetherapist($tid){
            $sql = "SELECT r.*, us.*, t.*
            FROM reservation r
            INNER JOIN user us ON us.user_ID = r.user_IDFK
            INNER JOIN therapist t ON t.therapist_ID = r.therapist_IDFK
            WHERE r.reservation_status != 'ACCEPTED' AND r.reservation_status != 'PENDING' AND t.therapist_ID = :tid ORDER BY r.reservation_datetime ASC
            ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':tid', $tid);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }


    }

?>