<?php

    include 'MVC/user_routes.php';
    include './middleware/message.php';

    if(isset($_POST['submitlog'])){
        $control->processlogin($_POST['emaillog'], $_POST['passwordlog']);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFF0F0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .background-image {
            position: absolute;
            top: 0;
            width: 100%;
            height: 450px;
            z-index: -1;
        }
        .shadow-container {
            background-color: #F5F5F5;
            border-radius: 10px;
            padding: 20px;
            max-width: 900px;
            width: 100%;
            margin-top: 100px;
        }
        .carousel-container {
            width: 100%;
            max-width: 400px;
            height: auto;
        }
        .carousel-inner img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .branding {
            font-size: 60px;
            color: #FF0000;
            text-align: center;
        }
        .subtext {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-button {
            background-color: #AC1515;
            color: #FFE141;
            width: 100%;
        }
        .text-center, .signup-link {
            text-align: center;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .shadow-container {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }
            .carousel-container {
                margin: 0 auto 20px;
            }
            .branding {
                font-size: 40px;
            }
            .login-button {
                margin-left: 0;
                transform: none;
            }
        }
    </style>
</head>
<body>
    <div class="background-image">
        <img src="images/spa.jpg" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div class="shadow-container shadow d-flex flex-column flex-md-row align-items-center">
        <div class="carousel-container">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/logo.png" class="d-block w-100" alt="Appointment Image">
                    </div>
                    <div class="carousel-item">
                        <img src="images/bg.png" class="d-block w-100" alt="Background Image">
                    </div>
                    <div class="carousel-item">
                        <img src="images/spa.jpg" class="d-block w-100" alt="Spa Image">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center p-3 w-100">
            <div class="branding">D&E</div>
            <div class="subtext">Home and Hotel Massage Service</div>
            <form action="login_form.php" method="post" class="w-100">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="emaillog" class="form-control" placeholder="Enter your Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="passwordlog" class="form-control" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="submitlog" class="btn btn-danger login-button">Login</button>
            </form>
            <div class="text-center"><a class="highlight-link" href="forgot_password.php">Forgot Password?</a></div>
            <div class="signup-link">Don't Have an Account? <a href="create_account.php" class="highlight-link">sign-up</a> here</div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
