<?php

include 'MVC/user_routes.php';

    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'USER'){
        header('location: login_form.php');
        exit;
    } else {
        $userID = $_SESSION['user_id'];
    }

    
    $user = $control->selectoneuser($userID);
    //var_dump($user);
    if(isset($_POST['uploadimg'])){
        if (isset($_FILES['photoupload']) && $_FILES['photoupload']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['photoupload'];
            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageData = file_get_contents($imageTmpName);

            $control->uploadimg($imageData, $userID);
        }
    }

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
    //$onecategory = $categorycontrol->fetchonecategory($cid);

    //use to display picture
    function dispservice($use){
        if (!empty($use)) {
            return 'data:image/jpeg;base64,' . base64_encode($use);
        } else {
            return "images/adduser.png"; // Default image
        }
    }


    if($_SERVER['REQUEST_METHOD'] === "GET"){
        if(isset($_GET['id'])){
            $value = $reservationcontrol->getreservation($userID, $_GET['id']);
            if(empty($value)){
                header('location: user_dashboard.php?mess=wrong');
            } else {
                $vall = $reservationcontrol->fetchresser($value['reservation_ID']);
            }
        }
        
    }
    





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_addservice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "side/css_dashboard.php"; ?>
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
    <?php include "side/sidebar.php"; ?>

    <div class="main_content1">
    <!-- TEMPLATE -->
        <div class="container" style="display: flex; align-items: center;">
            <div>
                <div style="color: #6B4A4A; font-size: 30px; font-weight: 700; line-height: 36px; text-align: center; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Avail Services
                </div>
                <div style="color: #6B4A4A;">
                    Reservation ID: <?php echo isset($value['reservation_ID']) ? $value['reservation_ID'] : ''; ?>
                </div>
            </div>
            <div style="margin-left: auto;">
                <a onclick="window.history.back()"><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Back</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

    


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
                                        <th scope="col">name</th>
                                        <th scope="col">description</th>
                                        <th scope="col">category</th>
                                        <th scope="col">duration</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">View</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <form method="POST" action="user_addservice.php">
                                            <input type="hidden" name="rid" value="<?php echo $value['reservation_ID']; ?>" >
                                            <?php foreach ($vall as $row): ?>
                                            <tr>
                                                <td class="hidd"><?php echo $row['service_ID']; ?></td>
                                                <td class="hidd"><?php echo $row['service_name']; ?></td>
                                                <td class="hidd"><?php echo $row['service_description']; ?></td>
                                                <td class="hidd"><?php $category = $categorycontrol->fetchonecategory($row['category_IDFK']); echo $category['category_name']; ?></td>
                                                <td class="hidd"><?php echo $row['service_duration']; ?></td>
                                                <td class="hidd"><?php echo $row['service_price']; ?></td>
                                                <td class="hidd">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row['service_ID']; ?>">Details</button>

                                                    <input type="hidden" name="service_duration[]" value="<?php echo $row['service_duration']; ?>">
                                                    <input type="hidden" name="service_price[]" value="<?php echo $row['service_price']; ?>">
                                                </td>
                                                <div class="modal fade" id="modal-<?php echo $row['service_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog moddd" style="max-width: 500px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 50%; transform: translate(-50%);">Service Details</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container" style="width: 250px; border: 1px solid #ccc;">
                                                                    <img src="<?php echo dispservice($row['service_image']); ?>" class="img-fluid" alt="Service Image">
                                                                </div>
                                                                <div style="font-size: 25px; margin-left: 50%; transform: translate(-50%); text-align: center;">
                                                                    <?php echo $row['service_name']; ?>
                                                                </div>
                                                                <div style="font-size: 15px; color: #828282; margin-left: 50%; transform: translate(-50%); text-align: center;">
                                                                    <?php echo $row['service_description']; ?>
                                                                </div>
                                                                <div class="row" style="margin-top: 30px;">
                                                                    <div class="col-6" style="font-size: 25px; padding-left: 30px;">Service ID</div>
                                                                    <div class="col-6" style="font-size: 25px; color: #828282;"><?php echo $row['service_ID']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6" style="font-size: 25px; padding-left: 30px;">Service Name</div>
                                                                    <div class="col-6" style="font-size: 25px; color: #828282;"><?php echo $row['service_name']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6" style="font-size: 25px; padding-left: 30px;">Service Price</div>
                                                                    <div class="col-6" style="font-size: 25px; color: #828282;"><?php echo $row['service_price']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6" style="font-size: 25px; padding-left: 30px;">Service Duration</div>
                                                                    <div class="col-6" style="font-size: 25px; color: #828282;"><?php echo $row['service_duration']; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-bs-dismiss="modal" class="btn">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                            <?php endforeach; ?>
                                           
                                        </form>
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





    <?php include "side/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>