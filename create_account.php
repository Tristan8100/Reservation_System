<?php

    include 'MVC/user_routes.php';

    //$control;
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['submitsign'])){
            //$_POST['rol']
            //$_POST['namesign']
            //$_POST['emailsign']
            //$_POST['passwordsign']
            $control->insertnewacc($_POST['rol'], $_POST['namesign'], $_POST['emailsign'], $_POST['passwordsign']);
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFF0F0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .background-img-container {
            position: absolute;
            top: 0;
            width: 100%;
            height: 450px;
            z-index: -1;
        }
        .form-container {
            background-color: #F5F5F5;
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            margin-top: 100px;
            max-width: 900px;
        }
        .carousel-container {
            display: none;
        }
        .form-title {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .submit-btn {
            background-color: #AC1515;
            color: #FFE141;
            margin-left: 50%;
            transform: translateX(-50%);
        }
        .login-link {
            margin-top: 20px;
            text-align: center;
        }
        .login-link a {
            color: #FFE141;
        }
        @media (min-width: 768px) {
            .carousel-container {
                display: block;
                width: 100%;
                max-width: 400px;
                height: 450px;
            }
            .carousel-inner {
                height: 100%;
            }
            .carousel-inner img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
    </style>
</head>
<body>
    <div class="background-img-container">
        <img src="images/spa.jpg" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div class="shadow form-container">
        <div class="row g-0">
            <div class="col-md-6 d-none d-md-block">
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
                                <img src="images/despa1.jpg" class="d-block w-100" alt="Background Image">
                            </div>
                            <div class="carousel-item">
                                <img src="images/despa4.jpg" class="d-block w-100" alt="Spa Image">
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
            <div class="col-md-6">
                <div class="p-3">
                    <div class="form-title">Create Account</div>
                    <form action="create_account.php" method="POST">
                        <input type="hidden" id="rol" name="rol" class="form-control" value="USER" required>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="namesign" class="form-control" placeholder="Enter your Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="emailsign" class="form-control" placeholder="Enter your Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="passwordsign" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" name="submitsign" class="btn btn-danger submit-btn">Sign-up</button>
                    </form>
                    <div class="login-link">Already have an Account? <a href="login_form.php">login</a> here</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>