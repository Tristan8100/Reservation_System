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


    $allcategory = $categorycontrol->fetchcategory();
    
    $alltherapist = $therapistcontrol->selectactivetherapist();
    $allservice = [];
    if(isset($_GET['id'])){
        $reservation = $reservationcontrol->getindividualreservation($_GET['id']);
        $allservice = $reservationcontrol->fetchresser($_GET['id']);
    }

    if(isset($_POST['submitres'])){
        $reservationcontrol->sendresched($_POST['user_email'], $_POST['resch'] ,$_POST['appointments'], $_POST['user_fullname'], $_POST['reservation_datetime'], $_POST['reservation_ID']);
    }

    if(isset($_POST['submitcancel'])){
        $_POST['cancellation_reason'];
        $reservationcontrol->sendcanceladmin($_POST['user_email'], $_POST['cancel'] , $_POST['user_fullname'], $_POST['cancellation_reason'], $_POST['reservation_ID'], $_POST['reservation_datetime']);
    }

    if(isset($_POST['selected_row']) && isset($_POST['submitaccept'])){
        $reservationcontrol->acceptreservation($_POST['reservation_ID'], $_POST['selected_row'], $_POST['user_fullname'], $_POST['reservation_datetime'], $_POST['accept'], $_POST['user_email'], $_POST['reservation_duration']);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_appointment_specific_user(pending)</title>
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
            <img src="<?php echo disp($reservation); ?>" class="img-fluid" alt="Responsive image">
    </div>
    <div>
                                                        
    </div>
    <div style="font-size: 25px; margin-left: 50%; transform: translate(-50%); text-align: center; color: black;">
        <?php echo isset($reservation['user_fullname']) ? $reservation['user_fullname'] : ''; ?>
    </div>
    <div style="font-size: 15px; color: #828282; margin-left: 50%; transform: translate(-50%); text-align: center;">
        <?php echo isset($reservation['user_email']) ? $reservation['user_email'] : ''; ?>
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-left: auto; text-align:right;">
                Account ID
            </div>
        </div>
        <div class="col-6" style="font-size: 25px; padding-left: 30px; color: black;">
            <div style="width: 50%; margin-right: auto; color: #828282;">
                <?php echo isset($reservation['user_ID']) ? $reservation['user_ID'] : ''; ?>
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
                <?php echo isset($reservation['user_fullname']) ? $reservation['user_fullname'] : ''; ?>
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
                <?php echo isset($reservation['user_number']) ? $reservation['user_number'] : ''; ?>
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
                <?php echo isset($reservation['reservation_ID']) ? $reservation['reservation_ID'] : ''; ?>
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
                <?php echo isset($reservation['reservation_type']) ? $reservation['reservation_type'] : ''; ?>
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
                <?php echo isset($reservation['reservation_name']) ? $reservation['reservation_name'] : ''; ?>
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
                <?php echo isset($reservation['reservation_phone']) ? $reservation['reservation_phone'] : ''; ?>
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
                <?php echo isset($reservation['reservation_datetime']) ? $reservation['reservation_datetime'] : ''; ?>
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
                <?php echo isset($reservation['reservation_address']) ? $reservation['reservation_address'] : ''; ?>
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
                <?php echo isset($reservation['reservation_landmark']) ? $reservation['reservation_landmark'] : ''; ?>
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
                <?php echo isset($reservation['reservation_remarks']) ? $reservation['reservation_remarks'] : ''; ?>
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
                                                                <td><?php echo isset($service['rs_reservation_duration']) ? $service['rs_reservation_duration'] : ''; ?> minutes</td>
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
            <div style="text-align: center; font-size: 30px;">Add Therapist</div>
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
                                            <form action="admin_manage_appointments_specificuser(pending).php" method="POST">
                                                    <input type="hidden" name="user_fullname" value="<?php echo $reservation['user_fullname']; ?>">
                                                    <input type="hidden" name="reservation_datetime" value="<?php echo $reservation['reservation_datetime']; ?>">
                                                    <input type="hidden" name="reservation_duration" value="<?php echo $reservation['reservation_duration']; ?>">
                                                    <input type="hidden" name="reservation_ID" value="<?php echo $reservation['reservation_ID']; ?>">
                                                    <input type="hidden" name="user_email" value="<?php echo $reservation['user_email']; ?>">
                                                    <input type="hidden" name="accept" value="Accepted">
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
                                                                        <th scope="col">Add</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach($alltherapist as $therapist): ?>
                                                                    <tr>
                                                                        <td><?php echo $therapist['therapist_ID']; ?></td>
                                                                        <td><?php echo $therapist['therapist_fullname']; ?></td>
                                                                        <td><?php echo $therapist['therapist_email']; ?></td>
                                                                        <td><?php echo $therapist['therapist_gender']; ?></td>
                                                                        <td><input type="radio" name="selected_row" value="<?php echo $therapist['therapist_ID']; ?>"></td>
                                                                    </tr>
                                                                    <?php endforeach ?>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" name="submitaccept">Submit</button>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">Cancel</button>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Ask customer to reschedule</button>
                                            </form>
                                            <a href="admin_manage_therapist_booked.php?datee=<?php echo date('Y-m-d', strtotime($reservation['reservation_datetime'])); ?>&subdate="><button>View Therapist Schedule on date()</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reschedule Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="admin_manage_appointments_specificuser(pending).php" method="POST">
                    <input type="hidden" name="user_fullname" value="<?php echo $reservation['user_fullname']; ?>">
                    <input type="hidden" name="reservation_datetime" value="<?php echo $reservation['reservation_datetime']; ?>">
                    <input type="hidden" name="reservation_ID" value="<?php echo $reservation['reservation_ID']; ?>">
                    <input type="hidden" name="user_email" value="<?php echo $reservation['user_email']; ?>">
                    <input type="hidden" name="resch" value="Reschedule">
                    <input type="hidden" name="data" value="<?php echo json_encode($reservation); ?>">
                <div class="modal-body contentt">
                        <button class="but" type="button">Add DateTime</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submitres" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                </div>
            </div>
            </div>


                        <!-- Modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cancellation Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="admin_manage_appointments_specificuser(pending).php" method="POST">
                    <input type="hidden" name="user_fullname" value="<?php echo $reservation['user_fullname']; ?>">
                    <input type="hidden" name="reservation_datetime" value="<?php echo $reservation['reservation_datetime']; ?>">
                    <input type="hidden" name="reservation_ID" value="<?php echo $reservation['reservation_ID']; ?>">
                    <input type="hidden" name="user_email" value="<?php echo $reservation['user_email']; ?>">
                    <input type="hidden" name="cancel" value="Cancelled">
                <div class="modal-body contentt">
                    <!-- Radio button options with full descriptions as values -->
                    <div class="mt-3">
                    <label for="reason">Select a reason for cancellation:</label><br>
                    <div>
                        <input type="radio" id="reason1" name="cancellation_reason" value="SPAM">
                        <label for="reason1">SPAM</label>
                    </div>
                    <div>
                        <input type="radio" id="reason2" name="cancellation_reason" value="Reason 2: Scheduling conflict">
                        <label for="reason2">Scheduling conflict</label>
                    </div>
                    <div>
                        <input type="radio" id="reason3" name="cancellation_reason" value="Out of Working Hours">
                        <label for="reason3">Out of Working Hours</label>
                    </div>
                    <div>
                        <input type="radio" id="reason4" name="cancellation_reason" value="Others">
                        <label for="reason3">Others</label>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submitcancel" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                </div>
            </div>
            </div>

        </div>


    



    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const buttonclick = document.querySelector('.but');
const contentt = document.querySelector('.contentt');

// Add new datetime input and remove button when clicking 'Add DateTime'
buttonclick.addEventListener('click', () => {
    const value = document.createElement('div');
    value.className = 'item';
    value.innerHTML = `
        <label for="appointment">Select a new appointment date and time:</label>
        <input type="datetime-local" id="appointment" name="appointments[]">
        <br>
        <button class="clk" type="button">remove</button>
    `;
    contentt.append(value);
});

// Event delegation: Listen for clicks on remove buttons inside contentt
contentt.addEventListener('click', (event) => {
    // Check if the clicked element has the class 'clk' (remove button)
    if (event.target.classList.contains('clk')) {
        // Remove the parent div of the clicked remove button
        event.target.parentElement.remove();
    }
});


        
        
    </script>
</body>
</html>