<?php

    

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //require 'phpmailer/src/Exception.php';
    //require 'phpmailer/src/PHPMailer.php';
    //require 'phpmailer/src/SMTP.php';
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    include "MVC/user_model.php";

    class usercontrol extends usermodel{

        public function insertnewacc($role, $name, $em, $pass){
            $val1 = $this->loginselect($em);
            if($val1 === 'NO USER'){
                //execute insertion
                $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

                $val = $this->createaccount($name, $em, $hashedPassword, $role);
                if($val === false){
                    echo "SERVER ERROR ON CREATING ACCOUNT";
                } else {
                    $randomNumber = round(rand(1000, 9999) + rand() / getrandmax(), 4);
                    $rand = floor($randomNumber);
                    $inscode = $this->insertcode($rand, $val['user_ID']);
                    if($inscode === true){
                        $this->sendmail($val['user_email'], $rand);
                    }
                }
                //header('location: create_account.php?mess="succ"');
            } else if ($val1) {
                //email already used
                header('location: create_account.php?mess="already_used"');
            } else if ($val1 === false){
                //error
                header('location: create_account.php?mess="err"');
            }
        }

        public function sendmail($email, $rand){
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gtristan543@gmail.com';
            $mail->Password = 'beyd fvmz dhdl xkcb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('gtristan543@gmail.com');
            $mail->addAddress($email); //marktristan260@gmail.com
            $mail->isHTML(true);
            $mail->Subject = "Verify Account";
            $mail->Body = "
            <div>code: ".$rand."</div>
            <a href='localhost/reservation_system/verify_account.php?codes=$rand'>Verify Account</a>";

            $mail->send();

            $message = 'Send Succesfully';

            header("Location: verify_account.php");
        }

        public function verifyaccount($code){
            $val = $this->selectcode($code);
            if($val === "NOT FOUND"){
                echo "WRONG CODE";
            } else if($val){
                $check = $this->updatestatus($val['user_ID']);
                if($check === true){
                    header("location: login_form.php?verified='SUCCESS'");
                } else {
                    echo "FAILED";
                }
            }

        }

        public function processlogin($em, $pass){
            $compare = $this->loginselect($em);
            if($compare === 'NO USER'){
                echo "NO USER FOUND";
            } else if ($compare) {
                if(password_verify($pass, $compare['user_password'])){
                    if($compare['user_status'] === "REGISTERED"){
                        $_SESSION['user_id'] = $compare['user_ID'];
                        $_SESSION['user_role'] = $compare['user_role'];
                        if($compare['user_role'] === 'USER'){
                            header("Location: user_dashboard.php");
                            exit();
                        } else if($compare['user_role'] === 'ADMIN'){
                            header("Location: admin_dashboard.php");
                            exit();
                        }
                        
                    } else {
                        //not verified
                        $randomNumber = round(rand(1000, 9999) + rand() / getrandmax(), 4);
                        $rand = floor($randomNumber);
                        $inscode = $this->insertcode($rand, $compare['user_ID']);
                        if($inscode === true){
                            $this->sendmail($compare['user_email'], $rand);
                        }
                    }
                    
                } else {
                    echo "WRONG CREDENTIALS";
                }
            }
        }

        public function forgorpass($em){
            $val = $this->loginselect($em);
            if($val){
                echo "yess";
                $randomNumber = round(rand(1000, 9999) + rand() / getrandmax(), 4);
                $rand = floor($randomNumber);
                $val2 = $this->insertcode($rand, $val['user_ID']);
                if($val2 === true){
                    $this->sendforgorpass($val['user_email'], $rand);
                } else {
                    echo "ERROR CODE";
                }
                
            } else {
                echo "WRONG EMAIL";
            }
        }

        public function sendforgorpass($email, $random){
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gtristan543@gmail.com';
            $mail->Password = 'beyd fvmz dhdl xkcb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('gtristan543@gmail.com');
            $mail->addAddress($email); //marktristan260@gmail.com
            $mail->isHTML(true);
            $mail->Subject = "Forgor Password";
            $mail->Body = "
            <div>code: ".$random."</div>
            <a href='localhost/reservation_system/forgot_password_code.php?forgor1=$random'>Forgor Password</a>";

            $mail->send();

            $message = 'Send Succesfully';
            header("location: forgot_password.php?messforgor='CHECK YOUR EMAIL'");
        }

        public function resetaccount($code){
            $val = $this->selectcode($code);
            if($val === "NOT FOUND"){
                echo "WRONG CODE";
            } else if($val){
                $check = $this->updatestatus($val['user_ID']);
                if($check === true){
                    header("location: login_form.php?verified='SUCCESS'");
                } else {
                    echo "FAILED";
                }
            }

        }

        public function updatepassword($pass, $code){
            echo $code;
            $val = $this->selectcode($code);
            if($val){
                $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
                $check = $this->updatepasswordDB($hashedPassword, $val['user_ID']);
                if($check === true){
                    //
                    $this->deletecode($val['user_ID']);
                    header('location: login_form.php');
                }
            } else {
                echo "----NO USER FOUND11";
            }
        }

        public function selectoneuser($id){
            return $this->selectuser($id);
        }

        public function uploadimg($im, $id){
            $im = $this->updatepic($im, $id);
            if($im === true){
                
            } else if($im === false){
                echo "falll";
            }
        }

        public function getUserImage($id) {
            $user = $this->selectuser($id);
            
            if ($user !== 'NOT FOUND' && isset($user['user_image'])) {
                $mimeType = $user['user_image_type'] ?? 'image/jpeg';
                return 'data:' . $mimeType . ';base64,' . base64_encode($user['user_image']);
            }
            
            return null;  // Or return a placeholder if no image is found
        }

        public function updatepassword2($pass, $id){
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
            $check = $this->updatepasswordDB($hashedPassword, $id);
            if($check){
                header('location: login_form.php');
            } else {
                return false;
            }
        }

        public function updateinfo($fn, $un, $id){
            $check = $this->updateinfoDB($fn, $un, $id);
            if($check){
                header('location: login_form.php');
            }
        }

        public function fetchusercount(){
            return $this->usercount();
        }


    }




    class therapistcontrol extends therapistmodel{

        public function createtherapist($tf, $te, $tg, $tn){
            $val = $this->addtherapist($tf, $te, $tg, $tn);
            if($val){
                header('location: admin_manage_therapist_add.php?mess="success"');
            }
        }

        public function selectalltherapist(){
            return $this->getall();
        }

        public function fetchonetherapist($id){
            return $this->getonetherapist($id);
        }

        public function selectactivetherapist(){
            return $this->allactive();
        }

        public function selectinactivetherapist(){
            return $this->allinactive();
        }

        public function getcount(){
            return $this->therapistcount();
        }

        public function updateonetherapist($tf, $te, $tg, $tn, $id){
            $val = $this->updatetherapist($tf, $te, $tg, $tn, $id);
            if($val){
                header('location: admin_manage_therapist.php?mess=successfull');
            }
        }

        public function deletetherapist($id){
            $val = $this->markasinactive($id);
            if($val){
                header("location: admin_manage_therapist_all.php");
            }
        }
    }




    class categorycontrol extends categorymodel {


        public function createcategory($cm, $cp){
            $check = $this->checkcategory($cp);
            if(!empty($check)){
                header('location: admin_manage_services_addcategory.php?warning=No-Duplication');
            } else if(empty($check)){
                $val = $this->addcategory($cm, $cp);
                if($val){
                    header('location: admin_manage_services_addcategory.php?mess=succ');
                }
            }
        }

        public function getcategorycount(){
            return $this->categorycount();
        }

        public function fetchcategory(){
            return $this->getallcategory();
        }

        public function editcategory($cn, $cp, $id){
            $check = $this->checkcategory2($cp, $id);
            if(!empty($check)){
                header('location: admin_manage_services_addcategory(edit).php?warning=No-Duplication');
            } else if(empty($check)){
                $val = $this->updatecategory($cn, $cp, $id);
                if($val){
                    header('location: admin_manage_services.php?mess=suuuuu');
                }
            }
        }

        public function fetchonecategory($id){
            return $this->getonecategory($id);
        }

    }



    class servicecontrol extends servicemodel {


        public function createservice($cidfk, $sn, $si, $sdesc, $sp, $sdur, $prefix){
            do {
                $randomNumber = rand(100000, 999999);
                //$prefix = "BI";  will use in the arguments
                $newid = $prefix . $randomNumber;
                $check = $this->getoneservice($newid);
            } while (!empty($check));
            $val = $this->addservice($newid, $cidfk, $sn, $si, $sdesc, $sp, $sdur);
            if($val){
                header('location: admin_manage_services.php?mess=successss');
            }
        }

        public function fetchallservice(){
            return $this->getallservice();
        }

        public function fetchoneservice($id){
            return $this->getoneservice($id);
        }

        public function editserviceimg($sn, $cidfk, $sm, $sdesc, $sp, $sdur, $id){
            $check = $this->editservicewithimage($sn, $cidfk, $sm, $sdesc, $sp, $sdur, $id);
            if($check === true){
                header('location: admin_manage_services.php?editmess=success');
            }
        }

        public function editservice($sn, $cidfk, $sdesc, $sp, $sdur, $id){
            return $this->editservicenoimage($sn, $cidfk, $sdesc, $sp, $sdur, $id);
        }


    }

    class reservationcontrol extends reservationmodel {
        
        public function addnewreservation($prefix, $uidfk, $rdt, $rp, $ra, $rl, $rg, $rr, $rname){
            do {
                $randomNumber = rand(100000, 999999);
                
                $newid = $prefix . $randomNumber;
                $check = $this->getallone($newid);
            } while (!empty($check));
            if($prefix === "HS"){
                $type = "HOME SERVICE";
            } else if($prefix === "WI"){
                $type = "WALK IN";
            }
            $val = $this->addreservation($newid, $uidfk, $rdt, $type, $rp, $ra, $rl, $rg, $rr, $rname);
            if($val){
                header('location: user_addservice.php?resID='.$newid.'');
            }
        }

        public function getreservation($usid, $rid){
            return $this->getreservationperuser($usid, $rid);
        }

        public function addservicereserve($ridfk, $sidfk, $uidfk, $duration, $price){
            $length = count($sidfk); // Assuming all arrays have the same length
            $totalduration = 0;
            $totalprice = 0.00;
            for ($i = 0; $i < $length; $i++) {
                $sidfk[$i];
                $totalduration += $duration[$i];
                $totalprice += $price[$i];

                $this->addreservationservice($ridfk, $sidfk[$i], $uidfk, $duration[$i], $price[$i]);
            }
            $this->updatedurprice($totalprice, $totalduration, $ridfk);
            header('location: user_dashboard.php?mess=added');
            
        }

        public function pendingreservationperuser($id){
            return $this->getpendinguser($id);
        }

        public function notpendingreservationperuser($id){
            return $this->getnotpendinguser($id);
        }

        public function fetchresser($rid){
            return $this->getresser($rid);
        }

        public function cancelreservation($id){
            return $this->cancelreserve($id);
        }

        public function countallpending(){
            return $this->countpending();
        }


    }

    

?>