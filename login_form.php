<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Set a fixed height for the carousel */
        .carousel-inner {
            height: 450px; /* Adjust as needed */
        }

        /* Ensure images fit their containers */
        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Maintain aspect ratio while cropping excess */
        }

        /* Add borders for debugging layout */
    
    </style>
</head>
<body style="background-color: #FFF0F0; display: flex; justify-content: center; margin-top: 100px;">

    <div style="border: 1px solid; position: absolute; top: 0%; width: 100%; height: 400px; z-index: -1;">
        <img src="images/spa.jpg" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div class="shadow" style="background-color: #F5F5F5; border-radius: 10px; padding: 20px; height: 480px; width: 900px;">
        <div class="row">
            <div class="col-6">
            <div class="carousel-container" style="width: 400px; height: 450px;">
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
                <div style="height: 100%; padding: 10px;">
                    <div style="font-size: 80px; margin-top: -20px; color: #FF0000; ">D&E</div>
                    <div style="margin-top: -20px; margin-bottom: 20px;">Home and Hotel Massage Service</div>
                    <form action="your-login-handler.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #AC1515; color: #FFE141; margin-left: 50%; transform: translate(-50%);">Login</button>
                    </form>
                    <div style="margin-left: 50%; transform: translate(-50%); text-align: center;"><a style="color: #FFE141;" href="">Forgot Password?</a></div>
                    <div style="margin-top: 40px; width: 300px; margin-left: 50%; transform: translate(-50%);">Don't Have an Account? <a href="" style="color: #FFE141;">sign-up</a> here</div>

                </div>
            </div>
        </div>
    </div>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>