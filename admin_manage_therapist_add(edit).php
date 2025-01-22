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


    //add therapist
    if(isset($_POST['edittherapist'])){
        echo "succ";
        $_POST['nametherapist'];
        $_POST['emailtherapist'];
        $_POST['contact_numbertherapist'];
        $_POST['gendertherapist'];
        $therapistcontrol->updateonetherapist($_POST['nametherapist'], $_POST['emailtherapist'], $_POST['gendertherapist'], $_POST['contact_numbertherapist'], $_POST['therapist_ID']); //updateonetherapist($tf, $te, $tg, $tn, $id)
    }

    //to catch if no value
    if(isset($_GET['editid'])){
        $val1 = $therapistcontrol->fetchonetherapist($_GET['editid']);
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_therapist_add(edit)</title>
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
                    Add Therapist
                </div>
            </div>
            <div style="margin-left: auto;">
                <a onclick="window.history.back()"><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Back</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

    <div class="container d-flex justify-content-center" style="margin-top: 30px;">
        <div class="shadow" style="background-color: #FFFFFF; padding: 20px; width: 500px; height: 530px; border-radius: 10px;">
            <form action="admin_manage_therapist_add(edit).php" method="POST" style="display: flex; flex-direction: column;">
                <div style="color: #6B4A4A; text-align: center; font-weight: 600; font-size: 30px; margin-top: 30px;">Add New Therapist</div>
                <div class="mb-3 row">
                <input type="hidden" class="form-control" value="<?php echo $val1['therapist_ID']; ?>" id="id" name="therapist_ID" required>
                    <div class="col" style="margin-top: 30px;">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?php echo isset($val1['therapist_fullname']) ? $val1['therapist_fullname'] : ''; ?>" id="name" name="nametherapist" required>
                    </div>
                    <div class="col" style="margin-top: 30px;" >
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?php echo isset($val1['therapist_email']) ? $val1['therapist_email'] : ''; ?>" id="email" name="emailtherapist" required>
                    </div>
                </div>
                <div class="mb-3 row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="number" class="form-control" id="contact_number" value="<?php echo isset($val1['therapist_number']) ? $val1['therapist_number'] : ''; ?>" name="contact_numbertherapist" required>
                    </div>
                    
                </div>

                <div class="mb-3" style="margin-top: 30px;">
                    <label class="form-label">Gender</label>
                    <div>
                        <input type="radio" id="male" name="gendertherapist" value="Male" <?php echo (isset($val1['therapist_gender']) && $val1['therapist_gender'] === 'Male') ? 'checked' : ''; ?> required>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gendertherapist" value="Female" <?php echo (isset($val1['therapist_gender']) && $val1['therapist_gender'] === 'Female') ? 'checked' : ''; ?> required>
                        <label for="female">Female</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="edittherapist" style="background-color: #6B4A4A; border-color: #6B4A4A;">Add</button>
            </form>
        </div>
    </div>

    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    
    </script>
</body>
</html>