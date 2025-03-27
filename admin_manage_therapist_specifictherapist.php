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

  
    //to ensure there's always an ID
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            try {
                $val = $therapistcontrol->fetchonetherapist($_GET['id']);
                if (!$val) {
                    // Handle case when no therapist is found
                    throw new Exception('Therapist not found.');
                }
            } catch (Exception $e) {
                header('Location: admin_manage_therapist_all.php');
                exit; // Important to stop further execution
            }  
        } else {
            header('Location: admin_manage_therapist_all.php');
            //exit;
        }

        if(isset($_GET['delete'])){
            //execute deletion
            echo "suuc";
            $therapistcontrol->deletetherapist($val['therapist_ID']);
        }
    }

    $therapistreservation = $reservationcontrol->fetchdonetherapist($val['therapist_ID']);
    

    $acceptreservation = $reservationcontrol->fetchacceptherapist($val['therapist_ID']);

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Therapist - Specific Therapist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "adminsidebar/css_dashboard.php"; ?>
    <style>
        body {
            background-color: #FFF0F0;
            font-family: 'Arial', sans-serif;
        }

        .pic0 {
            width: 50px;
            margin-top: 10px;
            cursor: pointer;
        }

        .main_content1 {
            padding: 20px;
            margin-left: 8%;
            max-width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #6B4A4A;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }

        .header p {
            color: #6B4A4A;
            font-size: 1.1rem;
            margin: 5px 0 0;
        }

        .back-button {
            background-color: #6B4A4A;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
        }

        .back-button:hover {
            background-color: #5a3a3a;
        }

        .therapist-profile {
            text-align: center;
            margin-bottom: 30px;
        }

        .therapist-profile h2 {
            color: #6B4A4A;
            font-size: 2rem;
            margin: 10px 0;
        }

        .therapist-profile p {
            color: #828282;
            font-size: 1rem;
        }

        .info-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .info-section h3 {
            color: #6B4A4A;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .info-label {
            color: #6B4A4A;
            font-weight: 600;
        }

        .info-value {
            color: #828282;
        }

        .table-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .table-section h3 {
            color: #6B4A4A;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .table-scroll {
            max-height: 500px;
            overflow-y: auto;
            border-radius: 10px;
        }

        .table thead th {
            background-color: #6B4A4A;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .table tbody td {
            color: #828282;
        }

        @media (max-width: 768px) {
            .main_content1 {
                margin-left: 0;
                padding: 10px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .header p {
                font-size: 1rem;
            }

            .therapist-profile h2 {
                font-size: 1.5rem;
            }

            .info-section h3,
            .table-section h3 {
                font-size: 1.3rem;
            }

            .info-row {
                font-size: 1rem;
            }

            .table thead th {
                font-size: 1rem;
            }

            .table tbody td {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" alt="Menu">
    <?php include "adminsidebar/sidebar.php"; ?>

    <div class="main_content1">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>Manage Appointments</h1>
                <p>Quick access to customer's appointment</p>
            </div>
            <button class="back-button" onclick="window.history.back()">Back</button>
        </div>

        <!-- Therapist Profile -->
        <div class="therapist-profile">
            <h2><?php echo $val['therapist_fullname']; ?></h2>
            <p>Therapist ID: <?php echo $val['therapist_ID']; ?></p>
        </div>

        <!-- Therapist Information -->
        <div class="info-section">
            <h3>Therapist Details</h3>
            <div class="info-row">
                <span class="info-label">Therapist ID:</span>
                <span class="info-value"><?php echo $val['therapist_ID']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value"><?php echo $val['therapist_email']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value"><?php echo $val['therapist_fullname']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value"><?php echo $val['therapist_status']; ?></span>
            </div>
        </div>

        <!-- Done Appointments (Tracked) -->
        <div class="table-section">
            <h3>Done Appointments (Tracked)</h3>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($therapistreservation as $value): ?>
                        <tr>
                            <td><?php echo $value['reservation_ID']; ?></td>
                            <td><?php echo $value['reservation_datetime']; ?></td>
                            <td><?php echo $value['user_fullname']; ?></td>
                            <td><?php echo $value['reservation_status']; ?></td>
                            <td><a href="admin_manage_appointments_specificuser(tracked).php?id=<?php echo $value['reservation_ID']; ?>"><button class="back-button">View</button></a></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Accepted Appointments (Untracked) -->
        <div class="table-section">
            <h3>Accepted Appointments (Untracked)</h3>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($acceptreservation as $reservation): ?>
                        <tr>
                            <td><?php echo $reservation['reservation_ID']; ?></td>
                            <td><?php echo $reservation['reservation_datetime']; ?></td>
                            <td><?php echo $reservation['user_fullname']; ?></td>
                            <td><?php echo $reservation['reservation_status']; ?></td>
                            <td><a href="admin_manage_appointments_specificuser(untracked).php?id=<?php echo $reservation['reservation_ID']; ?>"><button class="back-button">View</button></a></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>