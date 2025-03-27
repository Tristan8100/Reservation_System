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

    

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $trackeduser = $reservationcontrol->notpendingreservationperuser($_GET['id']);
        $customer = $control->selectoneuser($_GET['id']);
    }
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Account</title>
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

            .user-profile img {
                width: 120px;
                height: 120px;
            }

            .user-profile h2 {
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
                <h1>Manage Accounts</h1>
                <p>Quick access to customer accounts</p>
            </div>
            <button class="back-button" onclick="window.history.back()">Back</button>
        </div>

        <!-- User Profile -->
        <div class="user-profile">
            <img src="<?php echo disp($customer); ?>" alt="User Image">
            <h2><?php echo $customer['user_ID']; ?></h2>
            <p><?php echo $customer['user_email']; ?></p>
        </div>

        <!-- User Information -->
        <div class="info-section">
            <h3>User Details</h3>
            <div class="info-row">
                <span class="info-label">Account ID:</span>
                <span class="info-value"><?php echo $customer['user_ID']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value"><?php echo $customer['user_fullname']; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone Number:</span>
                <span class="info-value"><?php echo $customer['user_number']; ?></span>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="table-section">
            <h3>Transaction History</h3>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Full Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($trackeduser as $track): ?>
                        <tr>
                            <td><?php echo $track['reservation_ID']; ?></td>
                            <td><?php echo $track['reservation_name']; ?></td>
                            <td><?php echo date('F j, Y, g:i A', strtotime($track['reservation_datetime'])); ?></td>
                            <td><?php echo $track['reservation_status']; ?></td>
                            <td><a href="admin_manage_appointments_specificuser(tracked).php?id=<?php echo $track['reservation_ID']; ?>"><button class="back-button">View</button></a></td>
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