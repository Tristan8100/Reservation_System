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
    <title>admin_manage_appointment_specific_user(tracked)</title>
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
                    Manage Appointments
                </div>
                <div style="color: #6B4A4A;">
                    Quick access to customer's appointment
                </div>
            </div>
            <div style="margin-left: auto;">
                <a onclick="window.history.back()"><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Back</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

    <div class="modal-body">
        <div class="container" style="width: 250px; height: 250px; border: 1px solid #ccc;">
            <img src="<?php echo disp($trackedperuser); ?>" class="img-fluid" alt="Responsive image">
    </div>
    <div>
                                                        
    </div>
    <div style="font-size: 25px; margin-left: 50%; transform: translate(-50%); text-align: center; color: black;">
        <?php echo isset($trackedperuser['user_fullname']) ? $trackedperuser['user_fullname'] : ''; ?>
    </div>
    <div style="font-size: 15px; color: #828282; margin-left: 50%; transform: translate(-50%); text-align: center;">
        <?php echo isset($trackedperuser['user_email']) ? $trackedperuser['user_email'] : ''; ?>
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Account ID
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['user_ID']) ? $trackedperuser['user_ID'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Name
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['user_fullname']) ? $trackedperuser['user_fullname'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Phone Number
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['user_number']) ? $trackedperuser['user_number'] : ''; ?>
            </div>
        </div>
    </div>
    <br>
    <div class="border"></div>
    <br>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Status
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['reservation_status']) ? $trackedperuser['reservation_status'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Reservation Type
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['reservation_type']) ? $trackedperuser['reservation_type'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Full Name
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['reservation_name']) ? $trackedperuser['reservation_name'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Phone Number
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
            <?php echo isset($trackedperuser['reservation_phone']) ? $trackedperuser['reservation_phone'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Date/Time
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['reservation_datetime']) ? $trackedperuser['reservation_datetime'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Address
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['reservation_address']) ? $trackedperuser['reservation_address'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Landmark
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($trackedperuser['reservation_landmark']) ? $trackedperuser['reservation_landmark'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Remarks
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282; font-size: 20px;">
            <?php echo isset($trackedperuser['reservation_remarks']) ? $trackedperuser['reservation_remarks'] : ''; ?>
            </div>
        </div>
    </div>
    </div>

    


        <div style="margin-top: 50px;">
            <div style="text-align: center; font-size: 30px;">Avail Services</div>
            <br>
            
            
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
                                                <div class="table-responsive table-scroll" 
                                                    data-mdb-perfect-scrollbar="true" 
                                                    style="position: relative; height: 300px;">
                                                    <table class="table table-striped mb-0" 
                                                        style="table-layout: fixed; width: 100%;">
                                                        <thead style="background-color: #002d72;">
                                                            <tr>
                                                                <th scope="col">Service ID</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Price</th>
                                                                <th scope="col">Duration</th>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>




    

            <br>
            <div style="text-align: center; font-size: 30px;">Booked Therapist</div>
            <br>

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
                                                        <div class="table-responsive table-scroll" 
                                                            data-mdb-perfect-scrollbar="true" 
                                                            style="position: relative; height: 300px;">
                                                            
                                                            <table class="table table-striped mb-0" 
                                                                style="table-layout: fixed; width: 100%;">
                                                                <thead style="background-color: #002d72;">
                                                                    <tr>
                                                                        <th scope="col">Therapist ID</th>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">Email</th>
                                                                        <th scope="col">Gender</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php if(isset($trackedperuser['therapist_IDFK'])): ?>
                                                                        <td><?php echo $trackedperuser['therapist_IDFK']; ?></td>
                                                                        <td><?php echo $therapistcontrol->fetchonetherapist($trackedperuser['therapist_IDFK'])['therapist_fullname']; ?></td>
                                                                        <td><?php echo $therapistcontrol->fetchonetherapist($trackedperuser['therapist_IDFK'])['therapist_email']; ?></td>
                                                                        <td><?php echo $therapistcontrol->fetchonetherapist($trackedperuser['therapist_IDFK'])['therapist_gender']; ?></td>
                                                                        <?php endif ?>
                                                                    </tr>
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
                </div>
            </div>

        </div>


    



    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>