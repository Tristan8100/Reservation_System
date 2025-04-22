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


    //category
    $allcategory = $categorycontrol->fetchcategory();
    $allservice = $servicecontrol->fetchallservice();
    //$onecategory = $categorycontrol->fetchonecategory($cid);
    $allreservation = $reservationcontrol->pendingreservationperuser($userID);

    if(isset($_GET['cancel'])){
        //execute the cancel process
        $reservationcontrol->cancelreservation($_GET['cancel']);
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>appointmentstatus</title>
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
        .cont2{
            width: 600px;
            position: fixed;
            top: 5%;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            display: none;
            max-height: 80vh;
            overflow-y: auto;
            padding: 20px;
            color: #333;
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }
        
        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0} 
            to {top:5%; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:5%; opacity:1}
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        
        
        @media (max-width: 700px) {
            .hidde {
                display: none;
            }
            .cont2 {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png">
    <?php include "side/sidebar.php"; ?>

    <div class="main_content1">
        <div style="padding: 10px; display:flex; justify-content:space-between; align-items: center;">
            <div>
            </div>
            <a style="background-color: #6B4A4A; color: white;" class="btn" href="user_dashboard.php" >Back</a>
        </div>

        <table class="table border">
            <thead style="color: #FFF0F0;">
                <tr>
                <th scope="col">Name</th>
                <th scope="col" class="hidde">Phone Number</th>
                <th scope="col">Date</th>
                <th scope="col" class="hidde">Reservation Type</th>
                <th scope="col">Status</th>
                <th scope="col">View</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($allreservation as $reserve): ?>
                <tr>
                <td><?php echo $reserve['reservation_name']; ?></td>
                <td class="hidde"><?php echo $reserve['reservation_phone']; ?></td>
                <td><?php echo date('F j, Y, g:i A', strtotime($reserve['reservation_datetime'])); ?></td>
                <td class="hidde"><?php echo $reserve['reservation_type']; ?></td>
                <td><?php echo $reserve['reservation_status']; ?></td>
                <td><button class="btn toch" id="<?php echo $reserve['reservation_ID']; ?>" style="background-color: #A1A1A1; color: white;">view</button></td>
                </tr>

                <div class="modal-overlay" id="overlay-<?php echo $reserve['reservation_ID']; ?>"></div>
                <div id="<?php echo $reserve['reservation_ID']; ?>" class="card cont2 shadow getpop">
                    <form class="forr">
                        <div class="text-center mb-4">
                            <h3 style="font-weight: 600; color: #6B4A4A;">Your Appointment</h3>
                        </div>
                        <div class="container">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Reservation ID:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['reservation_ID']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Reservation Type:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['reservation_type']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Reservation Date/Time:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo date('F j, Y, g:i A', strtotime($reserve['reservation_datetime'])); ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Phone Number:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['reservation_phone']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Preferred Therapist:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['reservation_gender']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Duration:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['reservation_duration']; ?> minutes
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Total:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        ₱<?php echo $reserve['reservation_total']; ?>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #6B4A4A;">
                                <h5 class="mb-3" style="color: #6B4A4A;">For Home Service:</h5>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Location:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['reservation_address']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Landmark:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['reservation_landmark']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Services:</strong>
                                    </div>
                                    <div class="col text-end">
                                        <a href="user_appointment_status(untracked).php?id=<?php echo $reserve['reservation_ID']; ?>" style="color: #6B4A4A; text-decoration: none;">View All</a>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Payment:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['reservation_payment']; ?>
                                    </div>
                                </div>
                                    
                                <?php if(isset($reserve['therapist_fullname'])): ?>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Assigned Therapist:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reserve['therapist_fullname']; ?>
                                    </div>
                                </div>
                                <?php endif ?>
                                
                                <div class="row">
                                    <div class="col">
                                        <strong>Remarks:</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-muted">
                                        <p><?php echo $reserve['reservation_remarks']; ?></p>
                                    </div>
                                </div>
                                
                                <?php if($reserve['reservation_status'] === "ACCEPTED"): ?>
                                    <!-- Empty for accepted status -->
                                <?php elseif($reserve['reservation_status'] === "PENDING"): ?>
                                    <div class="text-center mt-3">
                                        <a href="user_appointment_status.php?cancel=<?php echo $reserve['reservation_ID']; ?>" class="btn" style="color: #6B4A4A; text-decoration: none;">Cancel Reservation</a>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>

        
    </div>

    <?php include "side/js_sidebar.php"; ?>
    <script>
        const tochh = document.querySelectorAll('.toch');
        const popppi = document.querySelectorAll('.getpop');

        tochh.forEach(toccc =>{
            toccc.addEventListener('click', ()=>{
                event.stopPropagation()
                closeee();
                popppi.forEach(poss => {
                    if(event.target.id === poss.id){
                        console.log('here');
                        if(poss.style.display === 'none'){
                        poss.style.display = 'block';
                        }
                    }
                })
                
            })
        })

        function closeee(){
            popppi.forEach(popp =>{
                popp.style.display = 'none';
            })
        }

        document.addEventListener('click', ()=>{
            console.log(event.target);
            if(event.target.closest('.getpop')){
                console.log('catchh');
            } else {
                closeee();
            }
            
            
        })

      
    </script>
</body>
</html>