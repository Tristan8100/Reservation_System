<?php

include 'MVC/user_routes.php';

    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'USER'){
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

    if($_SERVER['REQUEST_METHOD'] === "GET"){
        if(isset($_GET['id'])){
            $trackedperuser = $reservationcontrol->fetchtrackedindividual($_GET['id']);
            $allservice = $reservationcontrol->fetchresser($_GET['id']);

            if($userID != $trackedperuser['user_ID']){
                header('location: user_access_history.php?mess=notallowed');
            }
        }  
    }
    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "side/css_dashboard.php"; ?>
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
            text-align: center;
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
        .table {
            table-layout: fixed;
            width: 100%;
        }
        .hidd {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" alt="Menu">
    <?php include "side/sidebar.php"; ?>

    <div class="main_content1">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>Manage Appointments</h1>
                <p>Quick access to customer's appointment</p>
            </div>
            <button class="back-button" onclick="window.history.back()">Back</button>
        </div>

        <!-- User Profile -->
        <div class="user-profile">
            <img src="<?php echo disp($trackedperuser); ?>" alt="User Image">
            <h2><?php echo isset($trackedperuser['user_fullname']) ? $trackedperuser['user_fullname'] : ''; ?></h2>
            <p><?php echo isset($trackedperuser['user_email']) ? $trackedperuser['user_email'] : ''; ?></p>
        </div>

        <!-- User Information -->
        <div class="info-section">
            <h3>User Details</h3>
            <div class="info-row">
                <span class="info-label">Account ID:</span>
                <span class="info-value"><?php echo isset($trackedperuser['user_ID']) ? $trackedperuser['user_ID'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value"><?php echo isset($trackedperuser['user_fullname']) ? $trackedperuser['user_fullname'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone Number:</span>
                <span class="info-value"><?php echo isset($trackedperuser['user_number']) ? $trackedperuser['user_number'] : ''; ?></span>
            </div>
        </div>

        <!-- Appointment Information -->
        <div class="info-section">
            <h3>Appointment Details</h3>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value"><?php echo isset($trackedperuser['reservation_status']) ? $trackedperuser['reservation_status'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Reservation Type:</span>
                <span class="info-value"><?php echo isset($trackedperuser['reservation_type']) ? $trackedperuser['reservation_type'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Full Name:</span>
                <span class="info-value"><?php echo isset($trackedperuser['reservation_name']) ? $trackedperuser['reservation_name'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone Number:</span>
                <span class="info-value"><?php echo isset($trackedperuser['reservation_phone']) ? $trackedperuser['reservation_phone'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date/Time:</span>
                <span class="info-value"><?php echo isset($trackedperuser['reservation_datetime']) ? $trackedperuser['reservation_datetime'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Address:</span>
                <span class="info-value"><?php echo isset($trackedperuser['reservation_address']) ? $trackedperuser['reservation_address'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Landmark:</span>
                <span class="info-value"><?php echo isset($trackedperuser['reservation_landmark']) ? $trackedperuser['reservation_landmark'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Remarks:</span>
                <span class="info-value hidd"><?php echo isset($trackedperuser['reservation_remarks']) ? $trackedperuser['reservation_remarks'] : ''; ?></span>
            </div>
        </div>

        <!-- Services Availed -->
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
                        <?php foreach($allservice as $service): ?>
                        <tr>
                            <td><?php echo isset($service['service_ID']) ? $service['service_ID'] : ''; ?></td>
                            <td><?php echo isset($service['service_name']) ? $service['service_name'] : ''; ?></td>
                            <td>₱<?php echo isset($service['service_price']) ? $service['service_price'] : ''; ?></td>
                            <td><?php echo isset($service['service_duration']) ? $service['service_duration'] : ''; ?> minutes</td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Booked Therapist -->
        <div class="table-section">
            <h3>Booked Therapist</h3>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Therapist ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($trackedperuser['therapist_IDFK'])): ?>
                        <tr>
                            <td><?php echo $trackedperuser['therapist_IDFK']; ?></td>
                            <td><?php echo $therapistcontrol->fetchonetherapist($trackedperuser['therapist_IDFK'])['therapist_fullname']; ?></td>
                            <td><?php echo $therapistcontrol->fetchonetherapist($trackedperuser['therapist_IDFK'])['therapist_email']; ?></td>
                            <td><?php echo $therapistcontrol->fetchonetherapist($trackedperuser['therapist_IDFK'])['therapist_gender']; ?></td>
                        </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "side/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>