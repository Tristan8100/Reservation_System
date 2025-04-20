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
    $allcategory = $categorycontrol->fetchcategory();
    $allservice = $servicecontrol->fetchallservice();

    //fetch the untracked
    $untrackedreservation = $reservationcontrol->getoneuntracked($_GET['id']);
    $reservationservices = $reservationcontrol->fetchresser($_GET['id']);

   

    if(isset($_POST['ns'])){
        $reservationcontrol->totrackreservation($_POST['idres'], $_POST['ns']);
    }

    if(isset($_POST['sc'])){
        $reservationcontrol->totrackreservation($_POST['idres'], $_POST['sc']);
    }

    //echo date('Y-m-d H:i:s', time());

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Appointment (Untracked)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "adminsidebar/css_dashboard.php"; ?>
    <style>
        body {
            background-color: #FFF0F0;
            font-family: 'Arial', sans-serif;
        }
        .pic0 {
            width: 50px;
            margin: 10px;
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
        .user-profile {
            text-align: center;
            margin-bottom: 30px;
        }
        .user-profile img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid #6B4A4A;
            margin-bottom: 15px;
        }
        .user-profile h2 {
            color: #6B4A4A;
            font-size: 2rem;
            margin: 10px 0;
        }
        .user-profile p {
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
            max-height: 300px;
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
        .status-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .status-buttons button {
            background-color: #6B4A4A;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
        }
        .status-buttons button:hover {
            background-color: #5a3a3a;
        }
        .table {
            table-layout: fixed;
            width: 100%;
        }

        @media (max-width: 992px) {
            .header h1{
                font-size: large;
                width: 80%;
            }
            .header p{
                font-size: medium;
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
                <h1>Manage Appointments (<?php 
                    if (isset($untrackedreservation['reservation_datetime']) && $untrackedreservation['reservation_datetime'] < date('Y-m-d H:i:s', time())) {
                        echo "Untracked";
                    } else {
                        echo "Due Soon";
                    }
                ?>)</h1>
                <p>Quick access to customer's appointment</p>
            </div>
            <button class="back-button" onclick="window.history.back()">Back</button>
        </div>

        <!-- User Profile -->
        <div class="user-profile">
            <img src="<?php echo disp($untrackedreservation); ?>" alt="User Image">
            <h2><?php echo isset($untrackedreservation['user_fullname']) ? $untrackedreservation['user_fullname'] : ""; ?></h2>
            <p><?php echo isset($untrackedreservation['user_email']) ? $untrackedreservation['user_email'] : ""; ?></p>
        </div>

        <!-- User Information -->
        <div class="info-section">
            <h3>User Details</h3>
            <div class="info-row">
                <span class="info-label">Account ID:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['user_ID']) ? $untrackedreservation['user_ID'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['user_fullname']) ? $untrackedreservation['user_fullname'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone Number:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['user_number']) ? $untrackedreservation['user_number'] : ""; ?></span>
            </div>
        </div>

        <!-- Appointment Information -->
        <div class="info-section">
            <h3>Appointment Details</h3>
            <div class="info-row">
                <span class="info-label">Reservation ID:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_ID']) ? $untrackedreservation['reservation_ID'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Reservation Type:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_type']) ? $untrackedreservation['reservation_type'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Full Name:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_name']) ? $untrackedreservation['reservation_name'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone Number:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_phone']) ? $untrackedreservation['reservation_phone'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date/Time:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_datetime']) ? date('F j, Y, g:i A', strtotime($untrackedreservation['reservation_datetime'])) : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Address:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_address']) ? $untrackedreservation['reservation_address'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Landmark:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_landmark']) ? $untrackedreservation['reservation_landmark'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_payment']) ? $untrackedreservation['reservation_landmark'] : ""; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Remarks:</span>
                <span class="info-value"><?php echo isset($untrackedreservation['reservation_remarks']) ? $untrackedreservation['reservation_remarks'] : ""; ?></span>
            </div>
        </div>

        <!-- Avail Services -->
        <div class="table-section">
            <h3>Avail Services</h3>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Service ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reservationservices as $availed): ?>
                        <tr>
                            <td><?php echo $availed['service_IDFK']; ?></td>
                            <td><?php echo $availed['service_name']; ?></td>
                            <td>₱<?php echo $availed['reservation_price']; ?></td>
                            <td><?php echo $availed['rs_reservation_duration']; ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Assigned Therapist -->
        <div class="table-section">
            <h3>Assigned Therapist</h3>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Therapist ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $availed['therapist_IDFK']; ?></td>
                            <td><?php echo $therapistcontrol->fetchonetherapist($availed['therapist_IDFK'])['therapist_fullname']; ?></td>
                            <td><?php echo $therapistcontrol->fetchonetherapist($availed['therapist_IDFK'])['therapist_email']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Assigned Bed -->
        <div class="table-section">
            <h3>Assigned Bed</h3>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Bed ID</th>
                            <th>Name</th>
                            <th>Room</th>
                            <th>Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $availed['reservation_bedIDFK']; ?></td>
                            <td><?php echo $bedscontrol->getonebed($availed['reservation_bedIDFK'])['bed_name']; ?></td>
                            <td><?php echo $bedscontrol->getonebed($availed['reservation_bedIDFK'])['bed_name']; ?></td>
                            <td><?php echo $bedscontrol->getonebed($availed['reservation_bedIDFK'])['bed_name']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Status Buttons -->
        <?php if(isset($untrackedreservation['user_ID'])): ?>
            <?php if ($untrackedreservation['reservation_datetime'] < date('Y-m-d H:i:s', time())): ?>
                <form action="admin_manage_appointments_specificuser(untracked).php" method="POST" class="status-buttons">
                    <input type="hidden" name="idres" value="<?php echo $untrackedreservation['reservation_ID']; ?>">
                    <button type="submit" name="ns" value="NO-SHOW">No-Show</button>
                    <button type="submit" name="sc" value="SUCCESS">Success</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>