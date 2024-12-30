<?php

    include 'MVC/user_routes.php';

    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'ADMIN'){
        header('location: login_form.php');
        exit;
    } else {
        $userID = $_SESSION['user_id'];
    }


    $user = $control->selectoneuser($userID);


    function disp($use){
        if (!empty($use['user_image'])) {
            return 'data:image/jpeg;base64,' . base64_encode($use['user_image']);
        } else {
            return "images/adduser.png"; // Default image
        }
    }


    //category
    $categorycount = $categorycontrol->getcategorycount();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "adminsidebar/css_dashboard.php"; ?>
    <style>
        body{
            background-color: #FFF0F0;
        }
        .pic0{
            width: 50px;
        }
        .main_content1{
            padding: 10px;
            width: 90%;
            margin-left: 8%;
        }

        .intro {
        height: 100%;
        }

        table td,
        table th {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        }

        thead th {
        color: #fff;
        }

        .card {
        border-radius: .5rem;
        }

        .table-scroll {
        border-radius: .5rem;
        }

        .table-scroll table thead th {
        font-size: 1.25rem;
        }
        thead {
        top: 0;
        position: sticky;
        }

        .hidd {
            max-width: 200px; /* Adjust the width as needed */
            white-space: nowrap; /* Prevent wrapping to the next line */
            overflow: hidden; /* Hide overflowed content */
            text-overflow: ellipsis; /* Add '...' at the end */
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" style="margin-top: 10px;" >
    <?php include "adminsidebar/sidebar.php"; ?>

    <div class="main_content1">
    <!-- TEMPLATE -->
        <div class="container" style="display: flex; align-items: center;">
            <div>
                <div style="color: #6B4A4A; font-size: 30px; font-weight: 700; line-height: 36px; text-align: center; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Manage Services
                </div>
                <div style="color: #6B4A4A;">
                    Quick access to Services
                </div>
            </div>
            <div style="margin-left: auto;">
                <a href=""><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Log Out</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

        <div class="container" style="color: #6B4A4A; margin-top: 30px; font-size: 25px;">Status</div>

        <div class="container" style="margin-top: 30px; display: flex;">
            <div style="width: 50%;">
                <div class="border" style="padding: 10px; width: 370px; border-radius: 10px; background-color: #FFFFFF;">
                    <div style="font-size: 30px; color: #6B4A4A;">12</div>
                    <div style="font-size: 25px; color: #6B4A4A;">Services</div>
                </div>
            </div>
            

            <div style="width: 50%;">
                <div class="border" style="padding: 10px; width: 370px; border-radius: 10px; background-color: #FFFFFF; margin-left: auto;">
                    <div style="font-size: 30px; color: #6B4A4A;"><?php echo $categorycount['total_rows'] ?></div>
                    <div style="font-size: 25px; color: #6B4A4A;">Categories</div>
                </div>
            </div>
        </div>


        <div class="container" style="display: flex; align-items: center; margin-top: 50px;">
            <div>
                <div style="color: #6B4A4A; font-size: 30px; font-weight: 700; line-height: 36px; text-align: center; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Service Management Overview
                </div>
                <div style="color: #6B4A4A;">
                    Here’s a quick access to manage services
                </div>
            </div>
        </div>

        <div class="container">
            <div style="margin-top: 50px;">
                <div class="row">
                    <div class="col-4 d-flex justify-content-center">
                        <a href="admin_manage_services_allservices.php" style="text-decoration: none;">
                            <div class="shadow" style="width: 300px; height: 300px; border-radius: 10px; background-color: #FFFFFF;">
                                <div style="color: #6B4A4A; text-align: center; padding-top: 50px; font-weight: 700; font-size: 30px;">12</div>
                                <div style="color: #6B4A4A; text-align: center; font-size: 25px; font-weight: 700;">All Services</div>
                                <button style="margin-left: 50%; transform: translate(-50%); margin-top: 80px; background-color: #6B4A4A; font-size: 25px; color: #FFFFFF; border-radius: 10px; width: 175px; height: 42px;">View</button>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <a href="admin_manage_services_addcategory.php" style="text-decoration: none;">
                            <div class="shadow" style="width: 300px; height: 300px; border-radius: 10px; background-color: #FFFFFF;">
                                <div style="color: #6B4A4A; text-align: center; padding-top: 50px; font-weight: 700; font-size: 30px;">Add</div>
                                <div style="color: #6B4A4A; text-align: center; font-size: 25px; font-weight: 700;">Category</div>
                                <button style="margin-left: 50%; transform: translate(-50%); margin-top: 80px; background-color: #6B4A4A; font-size: 25px; color: #FFFFFF; border-radius: 10px; width: 175px; height: 42px;">View</button>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <a href="admin_manage_services_addservices.php" style="text-decoration: none;">
                            <div class="shadow" style="width: 300px; height: 300px; border-radius: 10px; background-color: #FFFFFF;">
                                <div style="color: #6B4A4A; text-align: center; padding-top: 50px; font-weight: 700; font-size: 30px;">Add Service</div>
                                <div style="width: 100px; height: 100px; margin-left: 50%; transform: translate(-50%);"><img src="images/message.png" alt="..." class="img-thumbnail"></div>
                                <button style="margin-left: 50%; transform: translate(-50%); margin-top: 20px; background-color: #6B4A4A; font-size: 25px; color: #FFFFFF; border-radius: 10px; width: 175px; height: 42px;">View</button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    



    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    
    </script>
</body>
</html>