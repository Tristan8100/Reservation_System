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

  
    //fetch therapist

    //$therapist = $therapistcontrol->selectalltherapist();
    //$therapist = $therapistcontrol->selectactivetherapist();
    //$therapist = $therapistcontrol->selectinactivetherapist();
    if(isset($_GET['status'])){
        if($_GET['status'] === "ACTIVE"){
            $therapist = $therapistcontrol->selectactivetherapist();
        } else if($_GET['status'] === "INACTIVE") {
            $therapist = $therapistcontrol->selectinactivetherapist();
        } else if($_GET['status'] === "ALL"){
            $therapist = $therapistcontrol->selectalltherapist();
        }
    } else if (!isset($_GET['status'])){
        $therapist = $therapistcontrol->selectalltherapist();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_therapist_all</title>
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
            max-width: 200px; /* Adjust the width as needed */
            white-space: nowrap; /* Prevent wrapping to the next line */
            overflow: hidden; /* Hide overflowed content */
            text-overflow: ellipsis; /* Add '...' at the end */
        }
        .container-flex {
            display: flex;
            align-items: center;
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
        .filter-button {
            margin-left: 10px;
        }
        .dropdown-filter-container {
            margin-top: 20px;
            margin-left: 30px;
            display: flex;
            align-items: center;
        }
        .dropdown-filter-container label {
            margin-right: 10px;
            font-weight: bold;
            color: #6B4A4A;
        }
        .dropdown-filter-container .form-select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #6B4A4A;
            width: 200px; /* Adjust width as needed */
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
                <div class="title">Manage All Therapist</div>
                <div class="subtitle">Quick access to all therapist</div>
            </div>
            <div style="margin-left: auto;">
                <a onclick="window.history.back()"><button class="back-button">Back</button></a>
            </div>
        </div>
        <!-- TEMPLATE -->

        <!-- Dropdown Filter -->
        <form method="GET" action="" class="dropdown-filter-container">
            <div class="row">
                <div class="col-md-4">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="ALL" <?= isset($_GET['status']) && $_GET['status'] === 'ALL' ? 'selected' : '' ?>>All</option>
                        <option value="ACTIVE" <?= isset($_GET['status']) && $_GET['status'] === 'ACTIVE' ? 'selected' : '' ?>>Active</option>
                        <option value="INACTIVE" <?= isset($_GET['status']) && $_GET['status'] === 'INACTIVE' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </form>

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
                                                                    <th scope="col">Therapist ID</th>
                                                                    <th scope="col">Email</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Gender</th>
                                                                    <th scope="col">Edit</th>
                                                                    <th scope="col">View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($therapist as $row): ?>
                                                                <tr>
                                                                    <td class="hidd"><?= $row['therapist_ID'] ?></td>
                                                                    <td class="hidd"><?= $row['therapist_email'] ?></td>
                                                                    <td class="hidd"><?= $row['therapist_fullname'] ?></td>
                                                                    <td class="hidd"><?= $row['therapist_gender'] ?></td>
                                                                    <td class="hidd">
                                                                        <a href="admin_manage_therapist_add(edit).php?editid=<?= $row['therapist_ID'] ?>">
                                                                            <button class="click-button">Edit</button>
                                                                        </a>
                                                                    </td>
                                                                    <td class="hidd">
                                                                        <a href="admin_manage_therapist_specifictherapist.php?id=<?= $row['therapist_ID'] ?>">
                                                                            <button class="click-button">View</button>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
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