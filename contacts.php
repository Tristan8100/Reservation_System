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
    <title>Contacts</title>
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
            justify-content: space-between;
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
        .section-header {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .section-header div:first-child {
            border-left: 5px solid #AC1515;
            height: 45px;
            margin-top: 5px;
        }
        .section-header div:last-child {
            margin-left: 10px;
            font-size: 45px;
            font-weight: 500;
            letter-spacing: 0.06em;
        }
        .back-button {
            display: flex;
            justify-content: flex-end;
            margin-top: -40px;
        }
        .back-button button {
            width: 124px;
            background-color: #6B4A4A66;
            border: none;
            color: rgba(61, 45, 45, 0.97);
            height: 33px;
            border-radius: 10px;
        }
        .contact-info {
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .contact-text {
            font-size: 30px;
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
            .section-header div:last-child {
                font-size: 30px;
            }
            .contact-text {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid header">
        <div>
            <div class="logo-text">D&E</div>
            <div class="subtext">Home and Hotel Massage Service</div>
        </div>
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo">
        </div>
    </div>

    <div class="container" style="padding: 10px;">
        <div class="section-header">
            <div></div>
            <div>Contacts</div>
        </div>
        <div class="back-button">
            <a onclick="window.history.back()">
                <button>&larr; Back</button>
            </a>
        </div>
    </div>

    <div class="container border border-danger mt-4"></div>

    <div class="container mt-5">
        <div class="section-header">
            <div></div>
            <div>Contact Number:</div>
        </div>
        <div class="contact-info">
            <div class="contact-text">0916-958-7504</div>
            <div class="contact-text">0919-359-6831</div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="section-header">
            <div></div>
            <div>Facebook Page:</div>
        </div>
        <div class="contact-info">
            <div class="contact-text">
                <a href="https://www.facebook.com/p/DE-Home-and-Hotel-Massage-Service-San-rafael-Baliwag-Pulilan-Branch-100085156867042/">
                    D&E Home and Hotel Massage Service - San Rafael, Baliwag & Pulilan Branch
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
