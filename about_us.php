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
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFF0F0;
        }
        .header {
            height: 200px;
            background-color: #131313;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }
        .logo-text {
            color: #FF0000;
            font-size: 80px;
            font-weight: 100;
            letter-spacing: 0.06em;
        }
        .subtext {
            color: #FFFFFF;
            font-size: 20px;
            font-weight: 200;
            text-decoration: underline;
        }
        .logo-container img {
            width: 170px;
            height: 170px;
        }
        .title {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .title-bar {
            border-left: 5px solid #AC1515;
            height: 45px;
            margin-right: 10px;
        }
        .about-title {
            font-size: 45px;
            font-weight: 500;
        }
        .back-button {
            width: 124px;
            background-color: #6B4A4A66;
            border: none;
            color: rgba(61, 45, 45, 0.97);
            height: 33px;
            border-radius: 10px;
        }
        .content-title {
            font-size: 35px;
            font-weight: 400;
        }
        .content-text {
            font-size: 25px;
            font-weight: 400;
            line-height: 30.3px;
        }
        @media (max-width: 768px) {
            .logo-text {
                font-size: 50px;
            }
            .subtext {
                font-size: 16px;
            }
            .logo-container img {
                width: 120px;
                height: 120px;
            }
            .logo-container {
                margin-top: 10px;
            }
            .about-title {
                font-size: 30px;
            }
            .content-title {
                font-size: 28px;
            }
            .content-text {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid header d-flex justify-content-between">
        <div>
            <div class="logo-text">D&E</div>
            <div class="subtext">Home and Hotel Massage Service</div>
        </div>
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo">
        </div>
    </div>

    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="title">
                <div class="title-bar"></div>
                <div class="about-title">About Us</div>
            </div>
            <button class="back-button" onclick="window.history.back()">&larr; Back</button>
        </div>
    </div>

    <div class="container border border-danger my-4"></div>

    <div class="container">
        <div class="content-title">Welcome To <span style="color: #AC1515;">D&E</span> Spa</div>
    </div>

    <div class="container my-4 content-text">
        D&E Spa was established by the owner Mr. Ernesto B. Bugayong. Mr Ernesto decided to establish the business to the public on the 1st of October of 2022. 
        The D&E Spa is currently located at San Roque Road, San Rafael, Bulacan. Before establishing the D&E Spa Business, Mr. Ernesto first had a Resto Bar that was located in Tarcan Baliwag, Bulacan. 
        The success of the first business inspired Mr. Ernesto to open a Spa Business. The name of the business came from the initials of Mr. Ernesto and the previous business partner, Mr. Dave.
    </div>

    <div class="container mb-4 content-text">
        D&E Spa was established by the owner Mr. Ernesto B. Bugayong. Mr Ernesto decided to establish the business to the public on the 1st of October of 2022. 
        The D&E Spa is currently located at San Roque Road, San Rafael, Bulacan. Before establishing the D&E Spa Business, Mr. Ernesto first had a Resto Bar that was located in Tarcan Baliwag, Bulacan. 
        The success of the first business inspired Mr. Ernesto to open a Spa Business. The name of the business came from the initials of Mr. Ernesto and the previous business partner, Mr. Dave.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
