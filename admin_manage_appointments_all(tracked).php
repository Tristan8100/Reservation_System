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



    $tracked = $reservationcontrol->fetchalltracked();

    if(isset($_GET['filter'])){
        if($_GET['status'] != "ALL" && $_GET['date'] === ""){
            $tracked = $reservationcontrol->fetchstatus($_GET['status']);
        } elseif($_GET['status'] == "ALL" && $_GET['date'] === ""){
            $tracked = $reservationcontrol->fetchalltracked();
        }

        if($_GET['date'] != "" && $_GET['status'] === "ALL"){
            $tracked = $reservationcontrol->fetchdate($_GET['date']);
        } elseif ($_GET['date'] != "" && $_GET['status'] != "ALL"){
            $tracked = $reservationcontrol->fetchdatestatus($_GET['date'], $_GET['status']);
        }
    }
    
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_appointments_all(tracked)</title>
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
        .container-flex {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }
        .container-flex .title {
            color: #6B4A4A;
            font-size: 30px;
            font-weight: 700;
            line-height: 36px;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
        }
        .container-flex .subtitle {
            color: #6B4A4A;
        }
        .container-flex .back-button,
        .click-button,
        .filter-button {
            background-color: #6B4A4A;
            color: white;
            border-radius: 10px;
            border: none;
            padding: 5px 15px;
            font-size: 14px;
            cursor: pointer;
        }
        .filter-container {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .filter-container label {
            font-weight: bold;
            color: #6B4A4A;
            margin-right: 5px;
        }
        .filter-container .form-select,
        .filter-container .date-input {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #6B4A4A;
            width: 200px;
            margin-right: 5px;
        }
        .filter-button {
            margin-left: 0;
            padding: 5px 15px;
            background-color: #6B4A4A;
            color: white;
            border-radius: 10px;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .main_content1 {
                width: 100%;
                margin-left: 0;
            }
            .form-container {
                display: flex;
                flex-direction: column;
            }
            .container-flex {
                flex-direction: column;
                align-items: flex-start;
            }
            .container-flex .title {
                font-size: 24px;
            }
            .filter-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            .filter-container .form-select,
            .filter-container .date-input {
                width: 80%;
                margin-right: 0;
            }
            .filter-button {
                width: 100%;
                margin-top: 5px;
            }
        }

        /* modal areas */
        .modal-dialog.moddd {
            max-width: 500px;
        }
        .modal-title.center {
            margin-left: 50%;
            transform: translate(-50%);
        }
        .modal-body .image-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 3px solid #6B4A4A;
        }
        .modal-body .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .modal-body .center-text {
            margin-left: 50%;
            transform: translate(-50%);
            text-align: center;
        }
        .modal-body .row-style {
            margin-top: 20px;
            font-size: 20px;
        }
        .modal-body .row-style .col-6 {
            padding-left: 30px;
        }
        .modal-body .row-style .col-6.gray {
            color: #828282;
        }
        .modal-footer .btn-view-reservation {
            background-color: #6B4A4A;
            color: white;
            border-radius: 10px;
            padding: 5px 15px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png">
    <?php include "adminsidebar/sidebar.php"; ?>

    <div class="main_content1">
        <!-- TEMPLATE -->
        <div class="container container-flex">
            <div>
                <div class="title">Manage Appointments (Tracked)</div>
                <div class="subtitle">Quick access to customers appointment</div>
            </div>
            <div style="margin-left: auto;">
                <a onclick="window.history.back()"><button class="back-button">Back</button></a>
            </div>
        </div>
        <!-- TEMPLATE -->

        <!-- Filter Section -->
        <div class="container filter-container">
            <form method="GET" action="admin_manage_appointments_all(tracked).php" class="d-flex align-items-center gap-2 form-container">
                <!-- Status Filter -->
                <label for="status-filter" class="filter-label">Filter by Status:</label>
                <select id="status-filter" name="status" class="form-select">
                    <option value="ALL">All</option>
                    <option value="SUCCESS" <?= isset($_GET['status']) && $_GET['status'] === 'SUCCESS' ? 'selected' : '' ?>>SUCCESS</option>
                    <option value="NO-SHOW" <?= isset($_GET['status']) && $_GET['status'] === 'NO-SHOW' ? 'selected' : '' ?>>NO-SHOW</option>
                    <option value="CANCELLED" <?= isset($_GET['status']) && $_GET['status'] === 'CANCELLED' ? 'selected' : '' ?>>CANCELLED</option>
                    <option value="RESCHEDULE" <?= isset($_GET['status']) && $_GET['status'] === 'RESCHEDULE' ? 'selected' : '' ?>>RESCHEDULE</option>
                    <option value="CANCELLED BY ADMIN" <?= isset($_GET['status']) && $_GET['status'] === 'CANCELLED BY ADMIN' ? 'selected' : '' ?>>CANCELLED by ADMIN</option>
                </select>

                <!-- Date Filter -->
                <label for="start-date">Date:</label>
                <input type="date" id="start-date" name="date" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>" class="form-control date-input">

                <!-- Submit Button -->
                <button type="submit" name="filter" class="filter-button">Filter</button>
            </form>
        </div>

        <!-- Table Section -->
        <div style="margin-top: 50px;">
            <div class="row">
                <div class="col-12">
                    <!-- The Table -->
                    <section class="intro">
                        <div class="bg-image h-100">
                            <div class="mask d-flex align-items-center h-100">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body p-0">
                                                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 500px">
                                                        <table class="table table-striped mb-0">
                                                            <thead style="background-color: #002d72;">
                                                                <tr>
                                                                    <th scope="col">Reservation ID</th>
                                                                    <th scope="col">Email</th>
                                                                    <th scope="col">Username</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Phone Number</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach($tracked as $done): ?>
                                                                <tr>
                                                                    <td class="hidd"><?= $done['reservation_ID'] ?></td>
                                                                    <td class="hidd"><?= $done['user_email'] ?></td>
                                                                    <td class="hidd"><?= $done['user_fullname'] ?></td>
                                                                    <td class="hidd"><?= $done['reservation_name'] ?></td>
                                                                    <td class="hidd"><?= $done['reservation_phone'] ?></td>
                                                                    <td class="hidd"><?= date('F j, Y, g:i A', strtotime($done['reservation_datetime'])) ?></td>
                                                                    <td class="hidd">                                                               <!-- override to use the modal -->
                                                                        <button class="click-button" data-bs-toggle="modal" data-bs-target="#<?= $done['reservation_ID'] ?>">View</button>
                                                                    </td>
                                                                    <!-- Modal -->               <!-- based here -->
                                                                    <div class="modal fade" id="<?= $done['reservation_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog moddd">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5 center" id="exampleModalLabel">Profile Details</h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="image-container">
                                                                                        <img src="<?= disp($done) ?>" class="img-fluid" alt="Profile Picture">
                                                                                    </div>
                                                                                    <div class="center-text" style="font-size: 25px;">
                                                                                        <?= $done['reservation_name'] ?>
                                                                                    </div>
                                                                                    <div class="center-text" style="font-size: 15px; color: #828282;">
                                                                                        <?= $done['user_ID'] ?>
                                                                                    </div>
                                                                                    <div class="row-style row">
                                                                                        <div class="col-6">Account ID</div>
                                                                                        <div class="col-6 gray"><?= $done['user_ID'] ?></div>
                                                                                    </div>
                                                                                    <div class="row-style row">
                                                                                        <div class="col-6">Name</div>
                                                                                        <div class="col-6 gray"><?= $done['user_fullname'] ?></div>
                                                                                    </div>
                                                                                    <div class="row-style row">
                                                                                        <div class="col-6">Phone Number</div>
                                                                                        <div class="col-6 gray"><?= $done['user_number'] ?></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="admin_manage_appointments_specificuser(tracked).php?id=<?= $done['reservation_ID'] ?>">
                                                                                        <button type="button" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-view-reservation">View Reservation</button>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End of Modal -->
                                                                </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- The Table -->
                </div>
            </div>
        </div>
    </div>

    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>