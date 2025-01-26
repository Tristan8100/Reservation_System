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
    //$onecategory = $categorycontrol->fetchonecategory($cid);
    $allreservation = $reservationcontrol->getallpendingreservation();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_appointments_all(pending)</title>
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
                    Manage Appointments (Pending)
                </div>
                <div style="color: #6B4A4A;">
                    Quick access to customers appointment
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
                                    <?php foreach($allreservation as $reserve): ?>
                                    <tr>
                                        <td class="hidd" ><?php echo $reserve['reservation_ID']; ?></td>
                                        <td class="hidd"><?php echo $reserve['user_email']; ?></td>
                                        <td class="hidd"><?php echo $reserve['user_fullname']; ?></td>
                                        <td class="hidd"><?php echo $reserve['reservation_name']; ?></td>
                                        <td class="hidd"><?php echo $reserve['reservation_phone']; ?></td>
                                        <td class="hidd"><?php echo date('F j, Y, g:i A', strtotime($reserve['reservation_datetime'])); if($reserve['reservation_datetime'] < date('Y-m-d H:i:s')) { echo " LATE"; }?></td>                  <!-- OVERRIDE WITH DATABASE VALUES data-bs-target -->
                                        <td class="hidd"><button data-bs-toggle="modal" data-bs-target="#<?php echo $reserve['reservation_ID']; ?>">click</button></td>
                                                                <!-- OVERRIDE WITH DATABASE VALUES ID SAME WITH data-bs-target -->
                                        <div class="modal fade" id="<?php echo $reserve['reservation_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog moddd" style="max-width: 500px;">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 50%; transform: translate(-50%);">Profile Details</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container" style="width: 250px; height: 250px; border: 1px solid #ccc;">
                                                        <img src="<?php echo disp($reserve); ?>" class="img-fluid" alt="Responsive image">
                                                    </div>
                                                    <div>
                                                        
                                                    </div>
                                                    <div style="font-size: 25px; margin-left: 50%; transform: translate(-50%); text-align: center;">
                                                        <?php echo $reserve['reservation_name']; ?>
                                                    </div>
                                                    <div style="font-size: 15px; color: #828282; margin-left: 50%; transform: translate(-50%); text-align: center;">
                                                        <?php echo $reserve['user_ID']; ?>
                                                    </div>
                                                    <div class="row" style="margin-top: 30px;">
                                                        <div class="col-6" style="font-size: 25px; padding-left: 30px;">
                                                            Account ID
                                                        </div>
                                                        <div class="col-6" style="font-size: 25px; color: #828282;">
                                                            <?php echo $reserve['user_ID']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6" style="font-size: 25px; padding-left: 30px;">
                                                            Name
                                                        </div>
                                                        <div class="col-6" style="font-size: 25px; color: #828282;">
                                                            <?php echo $reserve['user_fullname']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6" style="font-size: 25px; padding-left: 30px;">
                                                            Phone Number
                                                        </div>
                                                        <div class="col-6" style="font-size: 25px; color: #828282;">
                                                            <?php echo $reserve['user_number']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">              <!-- PASS ID AS GET -->
                                                    <a href="admin_manage_appointments_specificuser(pending).php?id=<?php echo $reserve['reservation_ID']; ?>"><button type="button"  data-bs-toggle="modal" data-bs-dismiss="modal" class="btn">View Reservation</button></a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                                <!-- END OF FIRST MODAL -->
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
        </div>


    



    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>