<?php

    session_start();

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['logout'])){
            session_unset();  // Clear session variables
            session_destroy();
            header('location: ../login_form.php');
            //exit();
        }
    }
    
    
    include 'user_controller.php';

    //include './middleware/message.php';

    $control = new usercontrol;

    $therapistcontrol = new therapistcontrol;

    $categorycontrol = new categorycontrol;

    $servicecontrol = new servicecontrol;

    $reservationcontrol = new reservationcontrol;

?>