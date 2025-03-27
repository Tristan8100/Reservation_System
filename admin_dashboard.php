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

    $allreservation = $reservationcontrol->getallpendingreservation();

    $countuntracked = $reservationcontrol->fetchalluntracked();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_dashboard</title>
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
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dashboard-header {
            color: #6B4A4A;
            font-size: 30px;
            font-weight: 700;
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
            width: 350px;
            border-radius: 10px;
            background-color: #FFFFFF;
            text-align: center;
        }
        .show-all-button {
            width: 100%;
            height: 40px;
            border-radius: 10px;
            background-color: #6B4A4A;
            color: white;
        }

        @media (max-width: 992px) {
            .main_content1 {
                margin-left: 0;
                width: 100%;
            }
            .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .status-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .status-box {
                width: 100%;
                margin-bottom: 10px;
            }
            .dashboard-header {
                font-size: 24px;
            }
            .logout-button{
                display: none;
            }
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png">
    <?php include "adminsidebar/sidebar.php"; ?>

    <div class="main_content1">
        <div class="container d-flex flex-wrap align-items-center justify-content-between text-center">
            <div>
                <div class="dashboard-header">Admin Dashboard</div>
                <div class="dashboard-subtext">Quick access to business information</div>
            </div>
            <div>
                <a href="MVC/user_routes.php?logout=1"><button class="logout-button">Log Out</button></a>
            </div>
        </div>

        <div class="container status-container">Status</div>

        <div class="container d-flex flex-wrap justify-content-between gap-3 mt-3 box-container">
            <div class="status-box border">
                <div style="font-size: 30px; color: #6B4A4A;"> <?php echo $control->fetchusercount()['total']; ?> </div>
                <div style="font-size: 25px; color: #6B4A4A;">Accounts</div>
            </div>
            <div class="status-box border">
                <div style="font-size: 30px; color: #6B4A4A;"> <?php echo $reservationcontrol->countallpending()['total']; ?> </div>
                <div style="font-size: 25px; color: #6B4A4A;">Pending Appointments</div>
            </div>
            <div class="status-box border">
                <div style="font-size: 30px; color: #6B4A4A;"> <?php echo $countuntracked['total']; ?> </div>
                <div style="font-size: 25px; color: #6B4A4A;">Untracked Appointments</div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="dashboard-header">Upcoming Appointments</div>
            <div class="dashboard-subtext">Here’s a quick access to upcoming appointments</div>
        </div>

        <div class="mt-5">
            <section class="intro">
                <div class="bg-image h-100">
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <div class="table-responsive table-scroll" style="position: relative; height: 500px">
                                                <table class="table table-striped mb-0">
                                                    <thead style="background-color: #002d72;">
                                                        <tr>
                                                            <th>Appointment ID</th>
                                                            <th>Email</th>
                                                            <th>Name</th>
                                                            <th>Reservation Name</th>
                                                            <th>Phone Number</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($allreservation as $reserve): ?>
                                                        <tr>
                                                            <td><?php echo $reserve['reservation_ID']; ?></td>
                                                            <td><?php echo $reserve['user_email']; ?></td>
                                                            <td><?php echo $reserve['user_fullname']; ?></td>
                                                            <td><?php echo $reserve['reservation_name']; ?></td>
                                                            <td><?php echo $reserve['reservation_phone']; ?></td>
                                                            <td><?php echo date('F j, Y, g:i A', strtotime($reserve['reservation_datetime'])); ?></td>
                                                        </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <a href="admin_manage_appointments_all(pending).php"><button class="show-all-button">Show All</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include "adminsidebar/js_sidebar.php"; ?>
</body>
</html>
