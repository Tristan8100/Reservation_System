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

    $categoryvalue = $categorycontrol->fetchcategory();

    //override
    if(isset($_POST['editservice'])){
        if(isset($_POST['categorypicture'])){
            if (isset($_FILES['categorypicture']) && $_FILES['categorypicture']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['categorypicture'];
                //$imageName = $image['name'];
                $imageTmpName = $image['tmp_name'];
                $imageData = file_get_contents($imageTmpName);
                //$control->uploadimg($imageData, $userID);
    
                $selectedValue = $_POST['selectcategory'];
                list($prefix, $cidfk) = explode('|', $selectedValue);
                //$_POST['categoryduration'];
                //override the process for edit
                //$servicecontrol->createservice($cidfk, $_POST['categoryname'], $imageData, $_POST['categorydesc'], $_POST['categoryprice'], $_POST['categoryduration'], $prefix);
            }
        } else if(!isset($_POST['categorypicture'])){
            //execute the code without pic
        }
        
    }

        //category
    if(isset($_GET['edit'])){
        $allservice = $servicecontrol->fetchoneservice($_GET['edit']);
    }
    
    //$onecategory = $categorycontrol->fetchonecategory($cid);
    
    //use to display picture
    function dispservice($use){
        if (!empty($use)) {
            return 'data:image/jpeg;base64,' . base64_encode($use);
        } else {
            return "images/adduser.png"; // Default image
        }
    }

    if(isset($_POST['editservice'])){
        if(!empty($_FILES['categorypicture']['tmp_name'])){
            if (isset($_FILES['categorypicture']) && $_FILES['categorypicture']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['categorypicture'];
                $imageName = $image['name'];
                $imageTmpName = $image['tmp_name'];
                $imageData = file_get_contents($imageTmpName);//the image file
    
                //$control->uploadimg($imageData, $userID);
                $_POST['service_ID'];
                $_POST['categoryname'];
                $_POST['categorydesc'];
                $_POST['categoryprice'];
                $_POST['categoryduration'];
                $_POST['selectcategory'];
                $servicecontrol->editserviceimg($_POST['categoryname'], $_POST['selectcategory'], $imageData, $_POST['categorydesc'], $_POST['categoryprice'], $_POST['categoryduration'], $_POST['service_ID']);
            }
        } else{
            echo "not set";
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_services_addservices(edit)</title>
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
                    Edit Services
                </div>
            </div>
            <div style="margin-left: auto;">
                <a href="admin_manage_services.php"><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Back</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

    <div class="container d-flex justify-content-center" style="margin-top: 30px;">
        <div class="shadow" style="background-color: #FFFFFF; padding: 20px; width: 500px; height: 600px; border-radius: 10px;">
            <form action="admin_manage_services_addservices(edit).php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                <div style="color: #6B4A4A; text-align: center; font-weight: 600; font-size: 30px; margin-top: 30px;">Edit Service</div>
                <div class="mb-3 row">
                <input type="hidden" class="form-control" id="service_ID" value="<?php echo isset($allservice['service_ID']) ? $allservice['service_ID'] : NULL; ?>" name="service_ID">
                    <div class="col" style="margin-top: 30px;">
                        <label for="sname" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="sname" value="<?php echo isset($allservice['service_name']) ? $allservice['service_name'] : ''; ?>" name="categoryname">
                    </div>
                    <div class="col" style="margin-top: 30px;" >
                        <label for="text" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="text" name="categorydesc"><?php echo isset($allservice['service_description']) ? $allservice['service_description'] : ''; ?></textarea>
                    </div>
                </div>
                <div class="mb-3 row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" value="<?php echo isset($allservice['service_price']) ? $allservice['service_price'] : ''; ?>" id="price" name="categoryprice">
                    </div>
                    <div class="col">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="number" value="<?php echo isset($allservice['service_duration']) ? $allservice['service_duration'] : ''; ?>" class="form-control" id="duration" name="categoryduration">
                    </div>
                </div>

                <div class="mb-3 row" style="margin-top: 30px;">
                <div class="col-6">
                    <label for="status-filter">Category:</label>
                    <select id="status-filter" name="selectcategory">
                        <?php foreach ($categoryvalue as $value): ?>
                            <option value="<?= $value['category_ID'] ?>" 
                                <?php echo (isset($allservice['category_IDFK']) && $allservice['category_IDFK'] == $value['category_ID']) ? 'selected' : ''; ?>>
                                <?= $value['category_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                    <div class="col-6">
                        <label for="picture">Choose a picture to upload:</label><br><br>
                        <input type="file" id="picture" name="categorypicture" accept="image/*">
                        <?php if (isset($allservice['service_image']) && !empty($allservice['service_image'])): ?>
                        <p>Current Image: <img src="<?= dispservice($allservice['service_image']); ?>" alt="Current Service Image" style="max-width: 100px;"></p>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="editservice" class="btn btn-primary" style="background-color: #6B4A4A; border-color: #6B4A4A;">Add</button>
                </div>
                

            </form>
        </div>
    </div>

    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    
    </script>
</body>
</html>