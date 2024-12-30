<?php

    session_start();
    
    include 'user_controller.php';

    $control = new usercontrol;

    $therapistcontrol = new therapistcontrol;

    $categorycontrol = new categorycontrol;

?>