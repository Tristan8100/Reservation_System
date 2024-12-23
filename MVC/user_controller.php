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
            $val = $this->selectcode($code);
            if($val){
                $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
                $check = $this->updatepassword($hashedPassword, $val['user_ID']);
                if($check === true){
                    header('location: login_form.php');
                }
            } else {
                echo "NO USER FOUND";
            }
        }

        public function selectoneuser($id){
            return $this->selectuser($id);
        }


    }

?>