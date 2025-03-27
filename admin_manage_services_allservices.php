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
    $allbeds = $bedscontrol->fetchactivebed();
    //$onecategory = $categorycontrol->fetchonecategory($cid);

    //use to display picture
    function dispservice($use){
        if (!empty($use)) {
            return 'data:image/jpeg;base64,' . base64_encode($use);
        } else {
            return "images/adduser.png"; // Default image
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['delete'])){
            $servicecontrol->markinactive($_GET['delete']);
        }

        if(isset($_GET['delcategory'])){
            $categorycontrol->markinactivecategory($_GET['delcategory']);
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_services_allservices</title>
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
        .click-button {
            background-color: #6B4A4A;
            color: white;
            border-radius: 10px;
            border: none;
            padding: 5px 15px;
            font-size: 14px;
            cursor: pointer;
        }
        .click-button {
            width: auto;
        }
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
                <div class="title">Manage Services</div>
                <div class="subtitle">Quick access to manage services</div>
            </div>
            <div style="margin-left: auto;">
                <a onclick="window.history.back()"><button class="back-button">Back</button></a>
            </div>
        </div>
        <!-- TEMPLATE -->
        <!-- For Service -->
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
                                                                    <th scope="col">Service ID</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Description</th>
                                                                    <th scope="col">Category</th>
                                                                    <th scope="col">Duration</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col">View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($allservice as $row): ?>
                                                                <tr>
                                                                    <td class="hidd"><?= $row['service_ID'] ?></td>
                                                                    <td class="hidd"><?= $row['service_name'] ?></td>
                                                                    <td class="hidd"><?= $row['service_description'] ?></td>
                                                                    <td class="hidd"><?php $category = $categorycontrol->fetchonecategory($row['category_IDFK']); echo $category['category_name']; ?></td>
                                                                    <td class="hidd"><?= $row['service_duration'] ?></td>
                                                                    <td class="hidd"><?= $row['service_price'] ?></td>
                                                                    <td class="hidd">
                                                                        <button class="click-button" data-bs-toggle="modal" data-bs-target="#<?= $row['service_ID'] ?>">View</button>
                                                                    </td>
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="<?= $row['service_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog moddd">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5 center" id="exampleModalLabel">Service Details</h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="image-container">
                                                                                        <img src="<?= dispservice($row['service_image']) ?>" class="img-fluid" alt="Service Image">
                                                                                    </div>
                                                                                    <div class="center-text" style="font-size: 25px;">
                                                                                        <?= $row['service_name'] ?>
                                                                                    </div>
                                                                                    <div class="center-text" style="font-size: 15px; color: #828282;">
                                                                                        <?= $row['service_description'] ?>
                                                                                    </div>
                                                                                    <div class="row-style row">
                                                                                        <div class="col-6">Service ID</div>
                                                                                        <div class="col-6 gray"><?= $row['service_ID'] ?></div>
                                                                                    </div>
                                                                                    <div class="row-style row">
                                                                                        <div class="col-6">Service Name</div>
                                                                                        <div class="col-6 gray"><?= $row['service_name'] ?></div>
                                                                                    </div>
                                                                                    <div class="row-style row">
                                                                                        <div class="col-6">Service Price</div>
                                                                                        <div class="col-6 gray"><?= $row['service_price'] ?></div>
                                                                                    </div>
                                                                                    <div class="row-style row">
                                                                                        <div class="col-6">Service Duration</div>
                                                                                        <div class="col-6 gray"><?= $row['service_duration'] ?></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="admin_manage_services_allservices.php?delete=<?= $row['service_ID'] ?>">
                                                                                        <button type="button" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-view-reservation">Delete</button>
                                                                                    </a>
                                                                                    <a href="admin_manage_services_addservices(edit).php?edit=<?= $row['service_ID'] ?>">
                                                                                        <button type="button" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-view-reservation">Edit</button>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End of Modal -->
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

        <!-- TEMPLATE -->
        <div class="container container-flex" style="margin-top: 30px;">
            <div>
                <div class="title">Manage Category</div>
                <div class="subtitle">Quick access to manage categories</div>
            </div>
        </div>
        <!-- TEMPLATE -->
        <!-- For Category -->
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
                                                                    <th scope="col">Category ID</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Prefix</th>
                                                                    <th scope="col">View</th>
                                                                    <th scope="col">Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($allcategory as $row): ?>
                                                                <tr>
                                                                    <td class="hidd"><?= $row['category_ID'] ?></td>
                                                                    <td class="hidd"><?= $row['category_name'] ?></td>
                                                                    <td class="hidd"><?= $row['category_prefix'] ?></td>
                                                                    <td class="hidd">
                                                                        <a href="admin_manage_services_addcategory(edit).php?edit=<?= $row['category_ID'] ?>">
                                                                            <button class="click-button">Edit</button>
                                                                        </a>
                                                                    </td>
                                                                    <td class="hidd">
                                                                        <a href="admin_manage_services_allservices.php?delcategory=<?= $row['category_ID'] ?>">
                                                                            <button class="click-button">Delete</button>
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

        <!-- TEMPLATE -->
        <div class="container container-flex" style="margin-top: 30px;">
            <div>
                <div class="title">Manage Beds</div>
                <div class="subtitle">Quick access to manage beds</div>
            </div>
        </div>
        <!-- TEMPLATE -->
        <!-- For Beds -->
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
                                                                    <th scope="col">Bed ID</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Room</th>
                                                                    <th scope="col">View</th>
                                                                    <th scope="col">Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($allbeds as $row): ?>
                                                                <tr>
                                                                    <td class="hidd"><?= $row['bed_ID'] ?></td>
                                                                    <td class="hidd"><?= $row['bed_name'] ?></td>
                                                                    <td class="hidd"><?= $row['bed_room'] ?></td>
                                                                    <td class="hidd">
                                                                        <a href="admin_manage_services_addcategory(edit).php?edit=<?= $row['bed_ID'] ?>">
                                                                            <button class="click-button">Edit</button>
                                                                        </a>
                                                                    </td>
                                                                    <td class="hidd">
                                                                        <a href="admin_manage_services_allservices.php?delcategory=<?= $row['bed_ID'] ?>">
                                                                            <button class="click-button">Delete</button>
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