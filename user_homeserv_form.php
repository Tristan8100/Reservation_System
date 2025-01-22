<?php

include 'MVC/user_routes.php';

    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'USER'){
        header('location: login_form.php');
        exit;
    } else {
        $userID = $_SESSION['user_id'];
    }

    
    $user = $control->selectoneuser($userID);
    //var_dump($user);
    if(isset($_POST['uploadimg'])){
        if (isset($_FILES['photoupload']) && $_FILES['photoupload']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['photoupload'];
            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageData = file_get_contents($imageTmpName);

            $control->uploadimg($imageData, $userID);
        }
    }

    function disp($use){
        if (!empty($use['user_image'])) {
            return 'data:image/jpeg;base64,' . base64_encode($use['user_image']);
        } else {
            return "images/adduser.png"; // Default image
        }
    }



    //$reservationcontrol;
    if(isset($_POST['addreservation'])){
        $reservationcontrol->addnewreservation($_POST['reservation_typepref'], $userID, $_POST['datetime'], 
        $_POST['phonenum'], $_POST['address'], $_POST['landmark'], $_POST['gender'], $_POST['remarks'], $_POST['fullname']);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home_service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "side/css_dashboard.php"; ?>
    <style>
        body{
            background-color: #FFF0F0;
        }
        .pic0{
            width: 50px;
        }
        .main_content1{
            padding: 10px;
            width: 90%;
            margin-left: 8%;
            display: flex;
            justify-content: center;
        }
        .cont2{
            width: 500px;
        }
        .forr{
            padding: 10px;
        }
        .fil{
            border-radius: 5px;
            height: 40px;
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" style="margin-top: 10px;" >
    <?php include "side/sidebar.php"; ?>

    <div class="main_content1">
        <div class="card cont2 shadow p-3">
            <form action="user_homeserv_form.php" method="POST" class="forr">
                <div class="textabove" style="font-size: 25px; font-weight: 500; text-align: center;">
                    Book Your Appointment (Home Service)
                </div>
                <br>
                <div class="nme">
                    <input type="hidden" class="fil" name="reservation_typepref" value="HS" style="border: 1px solid; width: 100%; ">
                    <label>Full Name</label>
                    <br>
                    <input type="text" class="fil" name="fullname" style="border: 1px solid; width: 100%; ">
                    <br><br>
                    <label>Contact Number</label>
                    <br>
                    <input type="number" class="fil" name="phonenum" style="border: 1px solid; width: 100%; ">
                    <br><br>

                    <label for="datetime">Select Date and Time:</label>
                    <br>
                    <input style="width: 100%;" name="datetime" class="fil" type="datetime-local" id="datetime" name="datetime">
                    <br><br>
                    
                    <label>Address</label>
                    <br>
                    <input type="text" class="fil" name="address" style="border: 1px solid; width: 100%; ">
                    <br><br>

                    <label>Landmark</label>
                    <br>
                    <input type="text" class="fil" name="landmark" style="border: 1px solid; width: 100%; ">
                    <br><br>

                    <div>Choose Therapist:</div>
                    <input type="radio" name="gender" value="Male">
                    <label>Male</label><br>

                    <input type="radio" name="gender" value="Female">
                    <label>Female</label><br><br>

                    <label>Remarks</label>
                    <br>
                    <textarea name="remarks" style="width: 100%; height: 150px;"></textarea>
                    <br><br>

                    <input name="addreservation" style="width: 100%; height: 40px; background-color: #6B4A4A; color:white; border-radius:10px;" type="submit">
                </div>
            </form>
        </div>
    </div>

    <?php include "side/js_sidebar.php"; ?>
</body>
</html>