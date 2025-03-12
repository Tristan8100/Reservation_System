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

    if(!isset($_SESSION['resid'])){
        header('location: user_dashboard.php');
    }

    if(isset($_SESSION['payment'] )){
        //function in controller to change payment
        $reservationcontrol->paydownpayment($_SESSION['payment'], $_SESSION['resid']);
    }

    if(isset($_GET['proceed'])){
        unset($_SESSION['payment']);
        unset($_SESSION['resid']);
        header('location: user_dashboard.php?mess=SUCCESS');
    }

    
    $user = $control->selectoneuser($userID);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

        .pay{
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .cont{
            width: 400px; border-radius: 10px; padding: 10px; background-color: white; height: 200px;
        }

        @media screen and (max-width: 908px) {
            .cont{
                width: 300px; border-radius: 10px; padding: 10px; background-color: white; height: 200px;
            }
            .display-image{
                display: none;
            }
        }

        @media screen and (max-width: 768px) {
            .pay {
                display: flex;
                flex-direction: column;

            }
            .cont{
                margin-bottom: 20px;
            }
        }

    </style>
</head>
<body style="background-color: #FFF0F0;">
    <div class="container-fluid" style="height: 200px; background-color: #131313;">
        <div style="width: 100%; height: 100%;">
            <div style="margin-left: 100px;">
                <div style="color: #FF0000; font-size: 100px; font-weight: 100; line-height: 121.18px; letter-spacing: 0.06em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    D&E
                </div>
                <div style="color: #FFFFFF; width: 250px; font-size: 20px; font-weight: 200; line-height: 24.24px; letter-spacing: 0.06em; text-align: left; text-decoration-line: underline; text-decoration-style: solid; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Home and Hotel Massage Service
                </div>
            </div>
            
            <div class="display-image" style="margin-left: auto; margin-top: -160px; width: 300px;">
                <img src="images/logo.png" style="width: 170px; height: 170px; top: 6px; left: 1170px; gap: 0px; opacity: 0px;">
            </div>
        </div>

    </div>

    <div class="container" style="margin-top: 30px;">
        <div class="container pay" style="height: 65vh; padding: 10px;">
    
            <div class="cont shadow">
                <div onclick='payment(<?php echo json_encode($user['user_fullname']); ?>, <?php echo json_encode($user['user_email']); ?>);' 
                    style="border: 1px solid; font-size: 25px; font-weight: 600; width: 100%; height: 100%; border-radius: 10px; color: #6B4A4A; display: flex; flex-direction: column; justify-content: center; align-items: center; text-decoration: none;">
                    Pay For Downpayment
                    <img src="images/cashless-payment.png" alt="payment" style="width: 50px; margin-top: 10px;">
                </div>
            </div>

            <div class="cont shadow">
                <a href="user_payment_choice.php?proceed" style="border: 1px solid;text-align: center; font-size: 25px; font-weight:600; width: 100%; height: 100%; border-radius: 10px; color: #6B4A4A; display: flex; flex-direction: column; justify-content: center; align-items: center; text-decoration: none">
                    Proceed Without Payment
                <img src="images/cashless-payment.png" alt="payment" style="width: 50px; margin-top: 10px;">
                </a>
            </div>
    
        </div>
    </div>

    

   
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function payment(name, email){
            console.log(name);
            console.log(email);

            fetch("/reservation_system/middleware/payment.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `username=${encodeURIComponent(name)}&useremail=${encodeURIComponent(email)}`,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                window.location.href = data.checkout_url; // Redirect to PayMongo checkout
            } else {
                alert("Payment creation failed: " + data.message);
                console.error(data.response);
            }
        })
        .catch(error => console.error("Error:", error));
        }
        
    </script>
</body>
</html>