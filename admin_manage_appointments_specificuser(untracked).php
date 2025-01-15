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
    <title>admin_manage_appointment_specific_user(untracked)</title>
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
                    Manage Appointments (<?php 
if (isset($untrackedreservation['reservation_datetime']) && $untrackedreservation['reservation_datetime'] < date('Y-m-d H:i:s', time())) {
    echo "Untracked";
} else {
    echo "due soon";
}
?>
)
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
            <img src="<?php echo disp($untrackedreservation); ?>" class="img-fluid" alt="Responsive image">
    </div>
    <div>
                                                        
    </div>
    <div style="font-size: 25px; margin-left: 50%; transform: translate(-50%); text-align: center; color: black;">
        <?php echo isset($untrackedreservation['user_fullname']) ? $untrackedreservation['user_fullname'] : ""; ?>
    </div>
    <div style="font-size: 15px; color: #828282; margin-left: 50%; transform: translate(-50%); text-align: center;">
        <?php echo isset($untrackedreservation['user_email']) ? $untrackedreservation['user_email']: ""; ?>
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Account ID
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($untrackedreservation['user_ID']) ? $untrackedreservation['user_ID']: ""; ?>
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
                <?php echo isset($untrackedreservation['user_fullname']) ? $untrackedreservation['user_fullname']: ""; ?>
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
                <?php echo isset($untrackedreservation['user_number']) ? $untrackedreservation['user_number']: ""; ?>
            </div>
        </div>
    </div>
    <br>
    <div class="border"></div>
    <br>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Reservation ID
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($untrackedreservation['reservation_ID']) ? $untrackedreservation['reservation_ID']: ""; ?>
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
                <?php echo isset($untrackedreservation['reservation_type']) ? $untrackedreservation['reservation_type']: ""; ?>
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
                <?php echo isset($untrackedreservation['reservation_name']) ? $untrackedreservation['reservation_name']: ""; ?>
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
                <?php echo isset($untrackedreservation['reservation_phone']) ? $untrackedreservation['reservation_phone']: ""; ?>
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
                <?php echo isset($untrackedreservation['reservation_datetime']) ? $untrackedreservation['reservation_datetime']: ""; ?>
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
                <?php echo isset($untrackedreservation['reservation_address']) ? $untrackedreservation['reservation_address']: ""; ?>
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
                <?php echo isset($untrackedreservation['reservation_landmark']) ? $untrackedreservation['reservation_landmark']: ""; ?>
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
                <?php echo isset($untrackedreservation['reservation_remarks']) ? $untrackedreservation['reservation_remarks']: ""; ?>
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
                                                            <?php foreach($reservationservices as $availed): ?>
                                                            <tr>
                                                                <td><?php echo $availed['service_IDFK']; ?></td>
                                                                <td><?php echo $availed['service_name']; ?></td>
                                                                <td><?php echo $availed['reservation_price']; ?></td>
                                                                <td><?php echo $availed['rs_reservation_duration']; ?></td>
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
            <div style="text-align: center; font-size: 30px;">Assigned Therapist</div>
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
                                                            style="position: relative; height: 100px;">
                                                            
                                                            <table class="table table-striped mb-0" 
                                                                style="table-layout: fixed; width: 100%;">
                                                                <thead style="background-color: #002d72;">
                                                                    <tr>
                                                                        <th scope="col">Therapist ID</th>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">email</th>
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
                                                </div>
                                                <form action="admin_manage_appointments_specificuser(untracked).php" method="POST">
                                                    <?php if(isset($untrackedreservation['user_ID'])): ?>

                                                        <?php 
                                                        if ($untrackedreservation['reservation_datetime'] < date('Y-m-d H:i:s', time())): ?>
                                                            <input type="hidden" name="idres" value="<?php echo $untrackedreservation['reservation_ID']; ?>">
                                                            <button type="submit" name="ns" value="NO-SHOW">No-Show</button>
                                                            <button type="submit" name="sc" value="SUCCESS">Success</button>
                                                        
                                                        <?php endif; ?>

                                                              
                                                        
                                                    <?php endif; ?>
                                                </form>
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