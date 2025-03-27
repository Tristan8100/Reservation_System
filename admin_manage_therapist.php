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

    //therapist count
    $count = $therapistcontrol->getcount();

    $counttoday = $reservationcontrol->fetchcounttoday();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Therapist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "adminsidebar/css_dashboard.php"; ?>
    <style>
        body {
            background-color: #FFF0F0;
        }

        .pic0 {
            width: 50px;
            margin-top: 10px;
        }

        .main_content1 {
            padding: 10px;
            width: 90%;
            margin-left: 8%;
        }

        .dashboard-header {
            color: #6B4A4A;
            font-size: 30px;
            font-weight: 700;
            line-height: 36px;
        }

        .dashboard-subtext {
            color: #6B4A4A;
        }

        .logout-button {
            background-color: #6B4A4A;
            width: 120px;
            color: white;
            border-radius: 10px;
        }

        .status-container {
            color: #6B4A4A;
            margin-top: 30px;
            font-size: 25px;
        }

        .status-box {
            padding: 10px;
            width: 30%;
            border-radius: 10px;
            background-color: #FFFFFF;
            text-align: center;
        }

        .management-container {
            margin-top: 50px;
            margin-bottom: 50px;;
        }

        .management-box {
            width: 300px;
            height: 300px;
            border-radius: 10px;
            background-color: #FFFFFF;
            text-align: center;
            padding-top: 50px;
            margin: 0 10px;
        }

        .management-box h2 {
            color: #6B4A4A;
            font-size: 30px;
            font-weight: 700;
        }

        .management-box p {
            color: #6B4A4A;
            font-size: 25px;
            font-weight: 700;
        }

        .management-box button {
            background-color: #6B4A4A;
            font-size: 25px;
            color: #FFFFFF;
            border-radius: 10px;
            width: 175px;
            height: 42px;
            margin-top: 20px;
        }

        .management-box img {
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }

        .add-therapist-box {
            width: 300px;
            height: 300px;
            border-radius: 10px;
            background-color: #FFFFFF;
            padding-top: 50px;
            margin: 0 10px;
        }

        .add-therapist-box h2 {
            color: #6B4A4A;
            font-size: 30px;
            font-weight: 700;
            text-align: center;
        }

        .add-therapist-box img {
            width: 100px;
            height: 100px;
            margin-left: 50%;
            transform: translateX(-50%);
        }

        .add-therapist-box button {
            background-color: #6B4A4A;
            font-size: 25px;
            color: #FFFFFF;
            border-radius: 10px;
            width: 175px;
            height: 42px;
            margin-top: 20px;
            margin-left: 50%;
            transform: translateX(-50%);
        }

        .management-box button{
            margin-top: 65px;
        }

        @media (max-width: 768px) {
            .main_content1 {
                margin-left: 0;
                width: 100%;
            }

            .status-container {
                flex-direction: column;
                align-items: center;
            }

            .status-content{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .status-box{
                margin-bottom: 30px;
                width: 80%;
            }

            .dashboard-header {
                font-size: 24px;
            }

            .logout-button {
                display: none;
            }

            .management-container .row {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 1250px) {
            .option-parent {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            .option-parent div {
                margin-bottom: 30px;
            }
        }

    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png">
    <?php include "adminsidebar/sidebar.php"; ?>

    <div class="main_content1">
        <!-- Header Section -->
        <div class="container d-flex align-items-center justify-content-between">
            <div>
                <div class="dashboard-header">Manage Therapist</div>
                <div class="dashboard-subtext">Quick access to therapist</div>
            </div>
            <div>
                <a href="MVC/user_routes.php?logout=1"><button class="logout-button">Log Out</button></a>
            </div>
        </div>

        <!-- Status Section -->
        <div class="container status-container">Status</div>

        <div class="container d-flex justify-content-between status-content">
            <div class="status-box border">
                <div style="font-size: 30px; color: #6B4A4A;"><?php echo $count['total_rows']; ?></div>
                <div style="font-size: 25px; color: #6B4A4A;">Therapist</div>
            </div>
            <div class="status-box border">
                <div style="font-size: 30px; color: #6B4A4A;"><?php echo $counttoday['total']; ?></div>
                <div style="font-size: 25px; color: #6B4A4A;">Booked Slots Today</div>
            </div>
        </div>

        <!-- Therapist Management Overview -->
        <div class="container management-container">
            <div class="dashboard-header">Therapist Management Overview</div>
            <div class="dashboard-subtext">Here’s a quick access to manage therapist</div>
        </div>

        <div class="container">
            <div class="row justify-content-center option-parent">
                <div class="col-4 d-flex justify-content-center">
                    <a href="admin_manage_therapist_all.php" style="text-decoration: none;">
                        <div class="management-box shadow">
                            <h2><?php echo $count['total_rows']; ?></h2>
                            <p>All Therapist</p>
                            <button>View</button>
                        </div>
                    </a>
                </div>
                <div class="col-4 d-flex justify-content-center">
                    <a href="admin_manage_therapist_booked.php" style="text-decoration: none;">
                        <div class="management-box shadow">
                            <h2>Access</h2>
                            <p>Booked Therapist</p>
                            <button>View</button>
                        </div>
                    </a>
                </div>
                <div class="col-4 d-flex justify-content-center">
                    <a href="admin_manage_therapist_add.php" style="text-decoration: none;">
                        <div class="add-therapist-box shadow">
                            <h2>Add Therapist</h2>
                            <img src="images/adduser.png" alt="Add Therapist" class="img-thumbnail">
                            <button>View</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>