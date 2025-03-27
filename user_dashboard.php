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
    //var_dump($user);
    
    //echo $_SESSION['user_role'];

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
        body {
            font-family: "Lato", arial ;
            background-color: #FFF0F0;
            padding: 0%;
            margin: 0%;
        }
        .navbar {
            border: 1px solid;
            background-color: #000000;
            height: 50px;
            display: flex;
            align-items: center;
        }
        .pic0 {
            border-color: white;
            height: 80%;
            margin-left: 10px;
        }
        .option {
            border-color: white;
            padding: 10px;
            margin-right: 10px;
            margin-left: auto;
        }
        .a {
            margin-left: 5px;
            padding: 5px;
            text-decoration: none;
            font-size: 25px;
            color: #AACA00;
        }
        .a:hover {
            background-color: #FFF0F0;
        }
        .header {
            height: 450px;
            overflow: hidden;
        }
        .pic1 {
            height: 200%;
            width: 100%;
            margin-top: -100px;
            object-fit: cover;
        }

        .text-body {
            font-size: 40px;
            width: 580px;
            margin: 50px;
            text-shadow: 1px 1px 1px black;
        }

        .services {
      
            padding: 10px;
            display: grid;
            grid-template-columns: auto auto auto;
        }
        .cardd1{
   
            padding: 10px;
            display: flex;
            justify-content: center;
        }
        .card1 {
            width: 300px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 10px;
            border-radius: 10px;
            background-color: #F0FFFF;
        }
        .pic2 {
            border-radius: 10px;
            width: 100%;
            height: 200px;
        }
        .text2 {
            padding: 10px;
            font-size: 25px;
            text-align: center;
        }
        .price {
            font-size: 30px;
            text-align: center;
            font-weight: 600;
            text-decoration: underline;
        }

        /* bofy part */
        .bodydiv {
            margin-top: 50px;
            height: 500px;
            background-image: url("images/bg.png");
            display: grid;
            grid-template-columns: auto auto;
            
        }
       .pic_bg {
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
       }
       .content_promotion {
            padding: 10px;
            display: flex;
            align-items: center;
       }
       .disp {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            width: 100%;
            height: 100%;
            border-radius: 20px;
            
       }
       .pic_bg2 {
            padding: 10px;
            width: 500px;
            height: 350px;
       }

       .parent_promote {
            width: 500px;
            padding: 10px;
            background-color: #FFF0F0;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
       }


       .promote {
           font-weight: 600;
            font-size: 50px;
            color: #614D4F;
            text-shadow: 2px 2px #000000;
            letter-spacing: 5px;
            margin-left: 20px;
       }
       .pg {
        padding: 10px;
            font-size: 20px;
       }
       .link {
            border-radius: 10px;
            background-color: #6B4A4A;
            color: white;
            border: 1px solid;
            width: 200px;
            height: 50px;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
       }

       /* footer */
       .footerr {
            background-color: #3F3F3F;
            padding: 10px;
            margin-top: 200px;
            height: 400px;
       }

       .info11 {
            width: 60%;
            display: flex;
            font-weight: 600;
            font-size: 25px;
            letter-spacing: 3px;
       }
       .red1 {
            width: 20px;
            height: 65px;
            background-color: red;
            margin-right: 20px;
       }
       .info2 {
            margin-top: 60px;
            display: grid;
            grid-template-columns: auto auto;
       }
       .ct1 {
            display: flex;
            font-weight: 600;
            font-size: 25px;
            letter-spacing: 3px;
            display: flex;
            flex-direction: column;
       }
       .iconn {
            width: 50px;
       }
       .red2 {
            width: 10px;
            height: 100%;
            background-color: red;
            display: flex;
            flex-direction: column;
       }
       .img_contain {
            display: flex;
            width: 400px;
       }
       .follow {
            margin-left: 20px;
            width: 200px;
       }
       .iconn {
            padding-top: 10px;
            margin-left: 20px;
       }
       .linkk {
            margin-left: 20px;
            font-size: 20px;
            color: #000000;
            text-decoration: none;
       }

       @media (max-width: 1200px) {
            .bodydiv{
                height: 850px;
            }
            .bodydiv{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
       }

       @media (max-width: 768px) {
            .services {
                display: flex;
                flex-direction: column;
            }
            .card1 {
                width: 200px;
               
            }
            .text2 {
                font-size: medium;
            }
            .price{
                font-size: large;
                font-weight: 600;
            }
            .pic2 {
                height: 150px;
            }
            .info11{
                font-size: large;
                width: 600px;
            }
            .info2{
                display: flex;
                flex-direction: column;
            }

            .promote{
                font-size: 40px;
            }
            .sidebar{
                width: 100px;
            }
            .options{
                font-size: 0px;
                padding-left: 30px;
            }
            .uppertext{
                font-size: 0px;
            }
            .uppertext_gmail{
                font-size: 0px;
            }
            .logout{
                width: 90px;
            }
        }

        @media (max-width: 600px) {
            .text-body{
                font-size: x-large;
                width: 400px;
            }
            .info11{
                font-size: large;
                width: 400px;
            }
            .red1{
                height: 90px;
            }
            .pic_bg{
                width: 400px;
            }
            .disp{
                height: 300px;
            }
            .content_promotion{
                width: 400px;
            }
        }
        
    </style>
    
</head>
<body>

    <!---->

        <?php include 'side/sidebar.php' ?>
        <?php //echo "hi user ".$user['user_fullname']."" ?>
        <div class="navbar">
            <img class="pic0" src="images/menu.png">
            <div class="option">
                <a class="a" href="services.php">Services</a>
                <a class="a" href="about_us.php">About Us</a>
                <a class="a" href="contacts.php">Contact</a>
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