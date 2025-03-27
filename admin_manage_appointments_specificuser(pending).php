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
    $allbed = $bedscontrol->fetchactivebed();

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

    if(isset($_POST['selected_bed']) && isset($_POST['selected_row']) && isset($_POST['submitaccept'])){
        $reservationcontrol->acceptreservation($_POST['reservation_ID'], $_POST['selected_row'], $_POST['user_fullname'], $_POST['reservation_datetime'], $_POST['accept'], $_POST['user_email'], $_POST['reservation_duration'], $_POST['selected_bed']);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Appointment (Pending)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "adminsidebar/css_dashboard.php"; ?>
    <style>
        body {
            background-color: #FFF0F0;
            font-family: 'Arial', sans-serif;
        }
        .pic0 {
            width: 50px;
            margin-top: 10px;
            cursor: pointer;
        }
        .main_content1 {
            padding: 20px;
            margin-left: 8%;
            max-width: 100%;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #6B4A4A;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }
        .header p {
            color: #6B4A4A;
            font-size: 1.1rem;
            margin: 5px 0 0;
        }
        .back-button {
            background-color: #6B4A4A;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 30px;
        }
        .back-button:hover {
            background-color: #5a3a3a;
        }
        .user-profile {
            text-align: center;
            margin-bottom: 30px;
        }
        .user-profile img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid #6B4A4A;
            margin-bottom: 15px;
        }
        .user-profile h2 {
            color: #6B4A4A;
            font-size: 2rem;
            margin: 10px 0;
        }
        .user-profile p {
            color: #828282;
            font-size: 1rem;
        }
        .info-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .info-section h3 {
            color: #6B4A4A;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        .info-label {
            color: #6B4A4A;
            font-weight: 600;
        }
        .info-value {
            color: #828282;
        }
        .table-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .table-section h3 {
            color: #6B4A4A;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .table-scroll {
            max-height: 300px;
            overflow-y: auto;
            border-radius: 10px;
            margin-bottom: 50px;
        }
        .table thead th {
            background-color: #6B4A4A;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
        }
        .table tbody td {
            color: #828282;
        }
        .status-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .status-buttons button {
            background-color: #6B4A4A;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
        }
        .status-buttons button:hover {
            background-color: #5a3a3a;
        }
        .modal-content {
            background-color: #FFF0F0;
            border-radius: 10px;
        }
        .modal-header {
            border-bottom: 1px solid #6B4A4A;
        }
        .modal-title {
            color: #6B4A4A;
        }
        .modal-footer {
            border-top: 1px solid #6B4A4A;
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" alt="Menu">
    <?php include "adminsidebar/sidebar.php"; ?>

    <div class="main_content1">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>Manage Appointments (Pending)</h1>
                <p>Quick access to customer's appointment</p>
            </div>
            <button class="back-button" onclick="window.history.back()">Back</button>
        </div>

        <!-- User Profile -->
        <div class="user-profile">
            <img src="<?php echo disp($reservation); ?>" alt="User Image">
            <h2><?php echo isset($reservation['user_fullname']) ? $reservation['user_fullname'] : ''; ?></h2>
            <p><?php echo isset($reservation['user_email']) ? $reservation['user_email'] : ''; ?></p>
        </div>

        <!-- User Information -->
        <div class="info-section">
            <h3>User Details</h3>
            <div class="info-row">
                <span class="info-label">Account ID:</span>
                <span class="info-value"><?php echo isset($reservation['user_ID']) ? $reservation['user_ID'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value"><?php echo isset($reservation['user_fullname']) ? $reservation['user_fullname'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone Number:</span>
                <span class="info-value"><?php echo isset($reservation['user_number']) ? $reservation['user_number'] : ''; ?></span>
            </div>
        </div>

        <!-- Appointment Information -->
        <div class="info-section">
            <h3>Appointment Details</h3>
            <div class="info-row">
                <span class="info-label">Reservation ID:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_ID']) ? $reservation['reservation_ID'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Reservation Type:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_type']) ? $reservation['reservation_type'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Full Name:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_name']) ? $reservation['reservation_name'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone Number:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_phone']) ? $reservation['reservation_phone'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date/Time:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_datetime']) ? date('F j, Y, g:i A', strtotime($reservation['reservation_datetime'])) : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Address:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_address']) ? $reservation['reservation_address'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Landmark:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_landmark']) ? $reservation['reservation_landmark'] : ''; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_payment']) ? $reservation['reservation_payment'] : 'No Payment'; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Remarks:</span>
                <span class="info-value"><?php echo isset($reservation['reservation_remarks']) ? $reservation['reservation_remarks'] : ''; ?></span>
            </div>
        </div>

        <!-- Avail Services -->
        <div class="table-section">
            <h3>Avail Services</h3>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Service ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Duration</th>
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

        <!-- Add Therapist and Bed -->
        <div class="table-section">
            <form action="admin_manage_appointments_specificuser(pending).php" method="POST">
                <input type="hidden" name="user_fullname" value="<?php echo $reservation['user_fullname']; ?>">
                <input type="hidden" name="reservation_datetime" value="<?php echo $reservation['reservation_datetime']; ?>">
                <input type="hidden" name="reservation_duration" value="<?php echo $reservation['reservation_duration']; ?>">
                <input type="hidden" name="reservation_ID" value="<?php echo $reservation['reservation_ID']; ?>">
                <input type="hidden" name="user_email" value="<?php echo $reservation['user_email']; ?>">
                <input type="hidden" name="accept" value="Accepted">
                <!-- Therapist table -->
                <h3>Add Therapist</h3>
                <div class="table-scroll">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Therapist ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Add</th>
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
                <!-- Beds table -->
                <h3>Add Beds</h3>
                <div class="table-scroll">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Bed ID</th>
                                <th>Name</th>
                                <th>Room</th>
                                <th>Access</th>
                                <th>Add</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($allbed as $bed): ?>
                            <tr>
                                <td><?php echo $bed['bed_ID']; ?></td>
                                <td><?php echo $bed['bed_name']; ?></td>
                                <td><?php echo $bed['bed_room']; ?></td>
                                <td><?php echo $bed['bed_access']; ?></td>
                                <td><input type="radio" name="selected_bed" value="<?php echo $bed['bed_ID']; ?>"></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="status-buttons">
                    <button type="submit" name="submitaccept">Submit</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">Cancel</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Ask customer to reschedule</button>
                </div>
            </form>
            <a href="admin_manage_therapist_booked.php?datee=<?php echo date('Y-m-d', strtotime($reservation['reservation_datetime'])); ?>&subdate=">
                <button class="back-button">View Therapist Schedule on <?php echo date('F j, Y', strtotime($reservation['reservation_datetime'])); ?></button>
            </a>
        </div>

        <!-- Reschedule Modal -->
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

        <!-- Cancellation Modal -->
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
                            <label for="reason">Select a reason for cancellation:</label><br>
                            <div>
                                <input type="radio" id="reason1" name="cancellation_reason" value="SPAM">
                                <label for="reason1">SPAM</label>
                            </div>
                            <div>
                                <input type="radio" id="reason2" name="cancellation_reason" value="Scheduling conflict">
                                <label for="reason2">Scheduling conflict</label>
                            </div>
                            <div>
                                <input type="radio" id="reason3" name="cancellation_reason" value="Out of Working Hours">
                                <label for="reason3">Out of Working Hours</label>
                            </div>
                            <div>
                                <input type="radio" id="reason4" name="cancellation_reason" value="Others">
                                <label for="reason4">Others</label>
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