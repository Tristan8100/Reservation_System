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
    
    echo $_SESSION['user_role'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <?php include 'side/css_dashboard.php'; ?>
    <style>
        
        
    </style>
    
</head>
<body>

    <!---->

        <?php include 'side/sidebar.php' ?>
        <?php echo "hi user ".$user['user_fullname']."" ?>
        <div class="navbar">
            <img class="pic0" src="images/menu.png">
            <div class="option">
                <a class="a" href="">Services</a>
                <a class="a" href="">About Us</a>
                <a class="a" href="">Contact</a>
            </div>
        </div>


        <div class="header">
            <img class="pic1" src="images/spa.jpg" alt="">
        </div>

        <div class="text-body">
            <strong>Indulge in Excellence:</strong>
            Unveiling Some of Our Best Spa Experiences
        </div>

        <div class="services">
            <div class="cardd1">
                <div class="card1">
                    <img class="pic2" src="images/img1.jfif">
                    <div class="text2">
                    1 hr and 30 minutes full body massage
                    </div>
                    <div class="price">
                        ₱599
                    </div>
                </div>
            </div>
            <div class="cardd1">
                <div class="card1">
                <img class="pic2" src="images/img2.jfif">
                <div class="text2">
                    2 hrs signature massage + foot spa
                </div>
                <div class="price">
                        ₱699
                    </div>
                </div>
            </div>
            <div class="cardd1">
                <div class="card1">
                <img class="pic2" src="images/img3.jfif">
                <div class="text2">
                    Manicure and pedicure + foot spa
                    </div>
                    <div class="price">
                        ₱500
                    </div>
                </div>
            </div>
        </div>


        <div class="bodydiv">
            <div class="pic_bg">
                <div class="pic_bg2">
                    <img class="disp" src="images/img4.jfif">
                </div>
            </div>
            <div class="content_promotion">
                <div class="parent_promote">
                    <div class="promote">
                    Start your spa adventure with just a click
                    </div>
                    <div class="pg">
                        Ready to unwind? Secure your spot and book your spa day today!
                    </div>
                    <div class="link">
                        Book An Appointment ->
                    </div>
                </div>
            </div>
        </div>


        <div class="footerr">
            <div class="info11">
                <div class="red1"></div>
                We collect several different types of information for various purposes to provide and improve our Service to you.
            </div>

            <div class="info2">
                <div class="ct1">
                    <div class="red2">
                        <div class="follow">
                            Follow Us:
                        </div>
                        <div class="img_contain">
                            <img class="iconn" src="images/insta.png" alt="">
                            <img class="iconn" src="images/fb.png" alt="">
                            <img class="iconn" src="images/twit.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="ct1">
                <div class="red2">
                        <div class="follow">
                            Visit Us At:
                        </div>
                        <div class="img_contain">
                            <a class="linkk" href="https://www.google.com/maps/dir//d%26e+spa/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x3397014829b461bf:0x1da6cef91c63906b?sa=X&ved=1t:3061&ictx=111">D&E Home and Hotel Massage Service - San rafael, Baliwag & Pulilan Branch</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        
        <?php include 'side/js_sidebar.php' ?>
        <script>
            
            

        </script>

    
</body>
</html>