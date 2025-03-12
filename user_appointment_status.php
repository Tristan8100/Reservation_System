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
        }
        @media (max-width: 700px) { /* Adjust 600px to your desired breakpoint */
        .hidde {
            display: none;
        }
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" style="margin-top: 10px;" >
    <?php include "side/sidebar.php"; ?>

    <div class="main_content1">

        <div style="padding: 10px; display:flex; justify-content:space-between; align-items: center;">
            <div>
            </div>
            <a style="background-color: #6B4A4A; color: white;" class="btn" href="user_dashboard.php" >Back</a>
        </div>

        <table class="table">
            <thead style="color: #FFF0F0;">
                <tr>
                <th scope="col">Name</th>
                <th scope="col" class="hidde">Phone Number</th>
                <th scope="col">Date</th>
                <th scope="col" class="hidde">Reservation Type</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($allreservation as $reserve): ?>
                <tr>
                <td><?php echo $reserve['reservation_name']; ?></td>
                <td class="hidde"><?php echo $reserve['reservation_phone']; ?></td>
                <td><?php echo date('F j, Y, g:i A', strtotime($reserve['reservation_datetime'])); ?></td>
                <td class="hidde"><?php echo $reserve['reservation_type']; ?></td> <!-- put id based on user id as well as getpop -->
                <td><?php echo $reserve['reservation_status']; ?></td>
                <td><button class="btn toch" id="<?php echo $reserve['reservation_ID']; ?>" style="background-color: #A1A1A1; color: white;">view</button></td>
                </tr>

                                  <!-- HERE -->
                <div style="display: flex; justify-content:center;">
                <div id="<?php echo $reserve['reservation_ID']; ?>" class="card cont2 shadow p-3 getpop" style="margin-top: -80px; display: none;">
                        <form class="forr">
                            <div class="textabove" style="font-size: 30px; font-weight: 500; text-align: center;">
                                Your Appointment
                            </div>
                            <br>
                            <div class="container">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="col card-title">Reservation ID</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reserve['reservation_ID']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Reservation type</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reserve['reservation_type']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Reservation Date/Time</h5>
                                        <h5 class="col card-title text-muted"><?php echo date('F j, Y, g:i A', strtotime($reserve['reservation_datetime'])); ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Phone number</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reserve['reservation_phone']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Preffered therapist</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reserve['reservation_gender']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Duration</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reserve['reservation_duration']; ?> minutes</h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Total</h5>
                                        <h5 class="col card-title text-muted">₱<?php echo $reserve['reservation_total']; ?></h5>
                                    </div>
                                    <div style="border: 1px solid; color:#6B4A4A;"></div>
                                    <h5>For Home Service:</h5>
                                    <div class="row">
                                        <h5 class="col card-title">location</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reserve['reservation_address']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">landmark</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reserve['reservation_landmark']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Services</h5>
                                        <a href="user_appointment_status(untracked).php?id=<?php echo $reserve['reservation_ID']; ?>">View All</a>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Payment</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reserve['reservation_payment']; ?></h5>
                                    </div>
                                        
                                    <?php if(isset($reserve['therapist_fullname'])): ?>
                                    <div class="row">
                                    <h5 class="col card-title">Assigned Therapist</h5>
                                    <h5 class="col card-title text-muted"><?php echo $reserve['therapist_fullname']; ?></h5>
                                    </div>
                                    <?php endif ?>
                                    <h5 class="col card-title">Remarks</h5>
                                    <p class="card-text"><?php echo $reserve['reservation_remarks']; ?></p>
                                    <?php if($reserve['reservation_status'] === "ACCEPTED"){
                                        echo "";
                                    } elseif($reserve['reservation_status'] === "PENDING") {
                                        echo '<a href="user_appointment_status.php?cancel=' . $reserve['reservation_ID'] . '" class="card-link">Cancel</a>';
                                    } ?>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
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