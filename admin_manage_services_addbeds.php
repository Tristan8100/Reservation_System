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



    if(isset($_POST['bedsub'])){
        //$bn, $br, $ba
        $bedscontrol->createbed($_POST['bedname'], $_POST['bedroom'], $_POST['access']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_services_addbeds</title>
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
        .header-text {
            color: #6B4A4A;
            font-size: 30px;
            font-weight: 700;
            line-height: 36px;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
        }
        .back-button {
            background-color: #6B4A4A;
            width: 120px;
            color: white;
            border-radius: 10px;
        }
        .form-container {
            margin-top: 30px;
            background-color: #FFFFFF;
            padding: 20px;
            width: 500px;
            height: 450px;
            border-radius: 10px;
        }
        .form-title {
            color: #6B4A4A;
            text-align: center;
            font-weight: 600;
            font-size: 30px;
            margin-top: 30px;
        }
        .form-label {
            margin-top: 30px;
        }
        .submit-button {
            background-color: #6B4A4A;
            border-color: #6B4A4A;
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
                <div class="header-text">
                    Add Beds
                </div>
            </div>
            <div style="margin-left: auto;">
                <a onclick="window.history.back()"><button class="back-button">Back</button></a>
            </div>
        </div>
        <!-- TEMPLATE -->

        <div class="container d-flex justify-content-center">
            <div class="shadow form-container">
                <form action="admin_manage_services_addbeds.php" method="POST" style="display: flex; flex-direction: column;">
                    <div class="form-title">Add New Beds</div>
                    <div class="row">
                        <div class="col form-label">
                            <label for="bedname" class="form-label">Bed Name</label>
                            <input type="text" class="form-control" id="bedname" name="bedname" required>
                        </div>
                        <div class="col form-label">
                            <label for="bedroom" class="form-label">Bed Room</label>
                            <input type="text" class="form-control" id="bedroom" name="bedroom" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-label">
                            <label for="access" class="form-label">Access</label>
                            <select id="access" name="access">
                                <option value="SOLO">SOLO</option>
                                <option value="SHARED">SHARED</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3" style="margin-top: 30px;"></div>
                    <button type="submit" name="bedsub" class="btn btn-primary submit-button">Add</button>
                </form>
            </div>
        </div>

        <?php include "adminsidebar/js_sidebar.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
        </script>
    </div>
</body>
</html>