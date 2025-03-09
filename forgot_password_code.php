<?php

    include 'MVC/user_routes.php';
    //$control
    if(isset($_GET['forgor1'])){
        //$control->resetaccount($_GET['forgor1']);// override
        header('location: reset_password.php?getcode='.$_GET['forgor1'].'');
    }

    if(isset($_POST['forg'])){
        //$control->resetaccount($_POST['resetacc']);
        header('location: reset_password.php?getcode='.$_POST['resetacc'].'');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot_Password_Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFF0F0;
            display: flex;
            justify-content: center;
            margin-top: 100px;
        }
        .background-img {
            position: absolute;
            top: 0%;
            width: 100%;
            height: 450px;
            z-index: -1;
        }
        .container-box {
            background-color: #F5F5F5;
            border-radius: 10px;
            padding: 20px;
            height: 480px;
            width: 900px;
            margin-top: 100px;
        }
        .carousel-container {
            width: 400px;
            height: 450px;
        }
        .carousel-inner {
            height: 450px;
        }
        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .form-container {
            height: 100%;
            padding: 10px;
        }
        .form-header {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 20px;
        }
        .form-subheader {
            margin-top: -10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 15px;
            color: #797979;
        }
        .submit-button {
            background-color: #AC1515;
            color: #FFE141;
            margin-left: 50%;
            transform: translate(-50%);
        }
        .login-link {
            margin-top: 40px;
            width: 300px;
            margin-left: 50%;
            transform: translate(-50%);
        }
    </style>
</head>
<body>
    <div class="background-img">
        <img src="images/spa.jpg" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div class="shadow container-box">
        <div class="row">
            <div class="col-6">
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
            </div>
            <div class="col-6">
                <div class="form-container">
                    <div class="form-header">Enter Forgot Password Code</div>
                    <div class="form-subheader">Enter forgot password code or click the link directly.</div>
                    <form action="verify_account.php" method="post" style="margin-top: 70px;">
                        <div class="mb-3">
                            <label for="number" class="form-label">Code</label>
                            <input type="number" id="number" name="resetacc" class="form-control" placeholder="Enter verification code" required>
                        </div>
                        <button type="submit" name="forg" class="btn btn-danger submit-button">Submit</button>
                    </form>
                    <div class="login-link">Already have an Account? <a href="login_form.php" style="color:#FFE141;">login</a> here</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
