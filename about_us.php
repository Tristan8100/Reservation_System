<?php 

include 'MVC/user_routes.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'USER'){
    header('location: login_form.php');
    exit;
} else {
    $userID = $_SESSION['user_id'];
}


function disp($use){
    if (!empty($use['user_image'])) {
        return 'data:image/jpeg;base64,' . base64_encode($use['user_image']);
    } else {
        return "images/adduser.png"; // Default image
    }
}


$user = $control->selectoneuser($userID);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About_Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #FFF0F0;">
    <div class="container-fluid" style="height: 200px; background-color: #131313;">
        <div class="" style="width: 100%; height: 100%;">
            <div style="margin-left: 100px;">
                <div style="color: #FF0000; font-size: 100px; font-weight: 100; line-height: 121.18px; letter-spacing: 0.06em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    D&E
                </div>
                <div style="color: #FFFFFF; width: 250px; font-size: 20px; font-weight: 200; line-height: 24.24px; letter-spacing: 0.06em; text-align: left; text-decoration-line: underline; text-decoration-style: solid; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Home and Hotel Massage Service
                </div>
            </div>
            
            <div class="" style="margin-left: auto; margin-top: -160px; width: 300px;">
                <img src="images/logo.png" style="width: 170px; height: 170px; top: 6px; left: 1170px; gap: 0px; opacity: 0px;">
            </div>
        </div>

    </div>

    <div class="container" style="padding: 10px;">
        <div>
            <div style="display: flex; margin-top: 20px;">
                <div style="border-left: 5px solid; color: #AC1515; height: 45px; margin-top: 5px; "></div>
                <div style="margin-left: 10px; font-family: Inter; font-size: 45px; font-weight: 500; line-height: 54.53px; letter-spacing: 0.06em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    About Us
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: -40px;">
                <a onclick="window.history.back()">
                    <button style="width: 124px; background-color: #6B4A4A66; border: none; color:rgba(61, 45, 45, 0.97); height: 33px; top: 214px; left: 1209px; gap: 0px; border-radius: 10px; opacity: 0px;"><- Back</button>
                </a>
            </div>
        </div>
    </div>

    <div class="container border border-danger" style="margin-top: 30px;"></div>

    <div class="container" style="margin-top: 50px;">
        <div style="font-size: 35px; font-weight: 400; line-height: 42.41px; letter-spacing: 0.06em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none;">
            Welcome To <span style="color: #AC1515;">D&E</span> Spa
        </div>
    </div>

    <div class="container" style="margin-top: 50px; font-family: Inter; font-size: 25px; font-weight: 400; line-height: 30.3px; letter-spacing: 0.06em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none;">
    D&E Spa was established by the owner Mr. Ernesto B. Bugayong. Mr Ernesto decided to establish the business to the public on the 1st of October of 2022. 
    The D&E Spa is currently located at San Roque Road, San Rafael, Bulacan. Before establishing the D&E Spa Business. 
    Mr. Ernesto first had a Resto Bar that is located in Tarcan Baliwag, Bulacan. The success of the first business inspires Mr. 
    Ernesto to open a Spa Business. The name of the business came from the initials of the name of Mr. Ernesto and the previous business 
    partner Mr. Dave.
    </div>

    <div class="container" style="margin-top: 50px; margin-bottom: 30px; font-family: Inter; font-size: 25px; font-weight: 400; line-height: 30.3px; letter-spacing: 0.06em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none;">
    D&E Spa was established by the owner Mr. Ernesto B. Bugayong. Mr Ernesto decided to establish the business to the public on the 1st of October of 2022. 
    The D&E Spa is currently located at San Roque Road, San Rafael, Bulacan. Before establishing the D&E Spa Business. 
    Mr. Ernesto first had a Resto Bar that is located in Tarcan Baliwag, Bulacan. The success of the first business inspires Mr. 
    Ernesto to open a Spa Business. The name of the business came from the initials of the name of Mr. Ernesto and the previous business 
    partner Mr. Dave.
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>