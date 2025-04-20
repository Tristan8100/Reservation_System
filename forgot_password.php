<?php

    include 'MVC/user_routes.php';

    require_once __DIR__ . '/middleware/encrypt_decrypt.php';
    require_once __DIR__ . '/middleware/message.php';

    if(isset($_POST['submitforgor'])){
        $control->forgorpass($_POST['emailforgor']);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #FFF0F0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .background-container {
            position: absolute;
            top: 0;
            width: 100%;
            height: 450px;
            z-index: -1;
        }

        .background-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-container {
            background-color: #F5F5F5;
            border-radius: 10px;
            padding: 20px;
            max-width: 900px;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 100px;
        }

        .carousel-container {
            width: 400px;
            height: 400px;
            display: block;
        }

        .form-section {
            flex: 1;
            padding: 20px;
        }

        .forgot-password-title {
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .forgot-password-subtext {
            text-align: center;
            font-size: 15px;
            color: #797979;
            margin-bottom: 50px;
        }

        .submit-btn {
            background-color: #AC1515;
            color: #FFE141;
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
        }

        .login-link a {
            color: #FFE141;
        }

        .form-content{
            margin-bottom: 100px;
        }

        @media (max-width: 990px) {
            .form-container {
                flex-direction: column;
                width: 70%;
            }
            .carousel-container {
                display: none;
            }
        }
        @media (max-width: 700px) {
            .form-container {
                flex-direction: column;
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="background-container">
        <img src="images/spa.jpg" alt="Spa Background">
    </div>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="form-container">
            <div class="carousel-container">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/logo.png" class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="images/bg.png" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="images/spa.jpg" class="d-block w-100" alt="Slide 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="form-section">
                <div class="forgot-password-title">Forgot Password</div>
                <div class="forgot-password-subtext">Enter your email address to receive a verification code.</div>
                <form class="form-content" action="forgot_password.php" method="post">
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="emailforgor" class="form-control" placeholder="Enter your Email" required>
                    </div>
                    <button type="submit" name="submitforgor" class="btn submit-btn btn-danger">Submit</button>
                </form>
                <div class="login-link">Already have an Account? <a href="login_form.php">login</a> here</div>
            </div>
        </div>
    </div>
</body>
</html>
