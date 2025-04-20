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

//delete reservation
if(isset($_GET['id'])){
    $reservationcontrol->deleteuserreservation($_GET['id'], $userID);
    
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
        to {top:0; opacity:1}
        }

        @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
        }

        @media (max-width: 700px) {
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
    <div class="heaad">
        <div style="font-size: 30px;">User Access History</div>
    </div>

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

                <div class="contr shadow" id="<?php echo $reservation['reservation_ID']; ?>" style="padding: 20px; width: 600px; border-radius: 15px; height: auto; position: fixed; color: #333; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
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
                                        <?php echo $reservation['reservation_ID']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Reservation Type:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reservation['reservation_type']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Reservation Date/Time:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo date('F j, Y, g:i A', strtotime($reservation['reservation_datetime'])); ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Phone Number:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reservation['reservation_phone']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Preferred Therapist:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reservation['reservation_gender']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Duration:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reservation['reservation_duration']; ?> minutes
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Total:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        ₱<?php echo $reservation['reservation_total']; ?>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #6B4A4A;">
                                <h5 class="mb-3" style="color: #6B4A4A;">For Home Service:</h5>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Location:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reservation['reservation_address']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Landmark:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reservation['reservation_landmark']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Payment:</strong>
                                    </div>
                                    <div class="col text-end text-muted">
                                        <?php echo $reservation['reservation_payment']; ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <strong>Services:</strong>
                                    </div>
                                    <div class="col text-end">
                                        <a href="user_access_history(tracked).php?id=<?php echo $reservation['reservation_ID']; ?>" style="color: #6B4A4A; text-decoration: none;">View All</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Remarks:</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-muted">
                                        <p><?php echo $reservation['reservation_remarks']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Delete:</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-muted">
                                        <a href="user_access_history.php?id=<?php echo $reservation['reservation_ID']; ?>" style="color: red; text-decoration: none;">Delete Reservation</a>
                                    </div>
                                </div>
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

        const toc = document.querySelectorAll('.tochh');
        const contr = document.querySelectorAll('.contr');

        console.log(sidebar);

        window.addEventListener('click', ()=> {
            event.stopPropagation();

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