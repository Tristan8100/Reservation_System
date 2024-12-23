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

        public function insertnewacc($em){
            $val = $this->loginselect($em);
            if($val === 'NO USER'){
                //execute insertion
                header('location: create_account.php?mess="succ"');
            } else if ($val) {
                //email already used
                header('location: create_account.php?mess="already_used"');
            } else if ($val === false){
                //error
                header('location: create_account.php?mess="err"');
            }
        }

    }

?>