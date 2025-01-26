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
$allreservation = $reservationcontrol->notpendingreservationperuser($userID);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accesshistory</title>
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
            width: 300px;
            position: fixed;
        }

        .contr {
            display: none;
            left: 50%;
            transform: translateX(-50%);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
        }

        @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
        }

        @media (max-width: 700px) { /* Adjust 600px to your desired breakpoint */
        .hidde {
            display: none;
        }
        }
    </style>
</head>
<body>
    <div class="container-fluid heaad" style="z-index: 0; padding: 10px; height: 50px; position: absolute; top: 0%; width: 70%; margin-left: 120px;">
        <div style="font-size: 30px;">User Access History</div>
    </div>

    <img class="pic0" src="images/menu.png" style="margin-top: 10px;" >
    <?php include "side/sidebar.php"; ?>

    
    <div class="main_content1">

        <div style="padding: 10px; display:flex; justify-content: end; align-items: center;">
            <a style="background-color: #6B4A4A; color: white;" class="btn"  href="user_dashboard.php" >Back</a>
        </div>

        <table class="table border">
            <thead style="color: #FFF0F0;">
                <tr>
                <th scope="col">Name</th>
                <th scope="col" class="hidde">Phone Number</th>
                <th scope="col">Date</th>
                <th scope="col" class="hidde">Status</th>
                <th scope="col">View</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach($allreservation as $reservation): ?>
                <tr>
                <td><?php echo $reservation['reservation_name']; ?></td>
                <td class="hidde"><?php echo $reservation['reservation_phone']; ?></td>
                <td><?php echo date('F j, Y, g:i A', strtotime($reservation['reservation_datetime'])); ?></td>
                <td class="hidde"><?php echo $reservation['reservation_status']; ?></td> <!-- put id based on user id as well as getpop -->
                <td><button class="btn tochh" id="<?php echo $reservation['reservation_ID']; ?>" style="background-color: #A1A1A1; color: white;">view</button></td>
                </tr>

                <div class="contr shadow" id="<?php echo $reservation['reservation_ID']; ?>" style="padding: 10px; width: 650px; border-radius: 10px; height: 600px; position: fixed; color: black; background-color: aliceblue;">
                <form class="forr">
                            <div class="textabove" style="font-size: 30px; font-weight: 500; text-align: center;">
                                Your Appointment
                            </div>
                            <br>
                            <div class="container">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="col card-title">Reservation ID</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reservation['reservation_ID']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Reservation type</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reservation['reservation_type']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Reservation Date/Time</h5>
                                        <h5 class="col card-title text-muted"><?php echo date('F j, Y, g:i A', strtotime($reservation['reservation_datetime'])); ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Phone number</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reservation['reservation_phone']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Preffered therapist</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reservation['reservation_gender']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Duration</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reservation['reservation_duration']; ?> minutes</h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">Total</h5>
                                        <h5 class="col card-title text-muted">₱<?php echo $reservation['reservation_total']; ?></h5>
                                    </div>
                                    <br>
                                    <h5>For Home Service</h5>
                                    <br>
                                    <div class="row">
                                        <h5 class="col card-title">location</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reservation['reservation_address']; ?></h5>
                                    </div>
                                    <div class="row">
                                        <h5 class="col card-title">landmark</h5>
                                        <h5 class="col card-title text-muted"><?php echo $reservation['reservation_landmark']; ?></h5>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <h5 class="col card-title">Services</h5>
                                    </div>
                                        <a href="user_access_history(tracked).php?id=<?php echo $reservation['reservation_ID']; ?>">View All</a>
                                    <br>
                                    <h5 class="col card-title">Remarks</h5>
                                    <p class="card-text"><?php echo $reservation['reservation_remarks']; ?></p>
                                </div>
                            </div>
                        </form>
                </div>
                <?php endforeach ?>




            </tbody>
        </table>

    </div>

    <?php include "side/js_sidebar.php"; ?>
    <script>
       //menuu 
        const heaad = document.querySelector('.heaad');
        const toc = document.querySelectorAll('.tochh');
        const contr = document.querySelectorAll('.contr');

        console.log(sidebar);
        function checckk(){
            heaad.style.marginLeft = '350px';
        }

        
        menuu.addEventListener('click', ()=> {
            checckk();
        })

        window.addEventListener('click', ()=> {
            event.stopPropagation();
            if(!sidebar.contains(event.target)){
                heaad.style.marginLeft = '120px';
            }

            if(!event.target.closest('.contr') && !event.target.closest('.tochh')){
                closeee();
            }
        })

        function controliterate(){
            //console.log('gee');
            contr.forEach(con => {
                if(event.target.id === con.id){
                    
                    con.style.display = 'block';
                }
            })
        }

        function closeee(){
            contr.forEach(con => {
                con.style.display = 'none';
            })
        }

        toc.forEach(to => {
            to.addEventListener('click', ()=>{
                closeee();
                controliterate();
            })
        })

        
        
      
    </script>
</body>
</html>