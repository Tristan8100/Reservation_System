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

    $count = $control->fetchusercount();
    $alluser = $control->fetchalluser();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "adminsidebar/css_dashboard.php"; ?>
    <style>
        body{
            background-color: #FFF0F0;
        }
        .pic0{
            width: 50px;
        }
        .main_content1{
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
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" style="margin-top: 10px;" >
    <?php include "adminsidebar/sidebar.php"; ?>

    <div class="main_content1">
    <!-- TEMPLATE -->
        <div class="container" style="display: flex; align-items: center;">
            <div>
                <div style="color: #6B4A4A; font-size: 30px; font-weight: 700; line-height: 36px; text-align: center; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Manage Accounts
                </div>
                <div style="color: #6B4A4A;">
                    Quick access to customer accounts
                </div>
            </div>
            <div style="margin-left: auto;">
                <a href="MVC/user_routes.php?logout=1"><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Log Out</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

        <div class="container" style="color: #6B4A4A; margin-top: 30px; font-size: 25px;">Total</div>

        <div class="container" style="margin-top: 30px; display: flex;">
            <div style="width: 50%;">
                <div class="border" style="padding: 10px; width: 370px; border-radius: 10px; background-color: #FFFFFF;">
                    <div style="font-size: 30px; color: #6B4A4A;"><?php echo $count['total']; ?></div>
                    <div style="font-size: 25px; color: #6B4A4A;">Accounts</div>
                </div>
            </div>
        </div>


        <div class="container" style="display: flex; align-items: center; margin-top: 50px;">
            <div>
                <div style="color: #6B4A4A; font-size: 30px; font-weight: 700; line-height: 36px; text-align: center; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    List of Accounts
                </div>
                <div style="color: #6B4A4A;">
                    Here’s a lists of accounts
                </div>
            </div>
        </div>

        <div style="margin-top: 50px;">
            <div class="row">
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
                                                    <th scope="col">Account ID</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Phone Number</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($alluser as $user): ?>
                                                <tr>
                                                    <td class="hidd"><?php echo $user['user_ID']; ?></td>
                                                    <td class="hidd"><?php echo $user['user_email']; ?></td>
                                                    <td class="hidd"><?php echo $user['user_fullname']; ?></td>
                                                    <td class="hidd"><?php echo $user['user_number']; ?></td>
                                                </tr>
                                                <?php endforeach ?>
                                                </tbody>
                                            </table>
                                            </div>
                                            <a href="admin_manage_account_all.php"><button style="width: 100%; height: 40px; border-radius: 10px; background-color: #6B4A4A; color: white;">Show All</button></a>
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
    



    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script>
    
    </script>
</body>
</html>