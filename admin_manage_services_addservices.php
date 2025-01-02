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
    if(isset($_POST['addservice'])){
        if (isset($_FILES['categorypicture']) && $_FILES['categorypicture']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['categorypicture'];
            //$imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageData = file_get_contents($imageTmpName);
            //$control->uploadimg($imageData, $userID);

            $selectedValue = $_POST['selectcategory'];
            list($prefix, $cidfk) = explode('|', $selectedValue);
            //$_POST['categoryduration'];

            $servicecontrol->createservice($cidfk, $_POST['categoryname'], $imageData, $_POST['categorydesc'], $_POST['categoryprice'], $_POST['categoryduration'], $prefix);
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_services_addservices</title>
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
                    Add Services
                </div>
            </div>
            <div style="margin-left: auto;">
                <a href=""><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Log Out</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

    <div class="container border border-danger d-flex justify-content-center" style="margin-top: 30px;">
        <div class="shadow" style="background-color: #FFFFFF; padding: 20px; width: 500px; height: 600px; border-radius: 10px;">
            <form action="admin_manage_services_addservices.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                <div style="color: #6B4A4A; text-align: center; font-weight: 600; font-size: 30px; margin-top: 30px;">Add New Services</div>
                <div class="mb-3 row">
                    <div class="col" style="margin-top: 30px;">
                        <label for="sname" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="sname" name="categoryname">
                    </div>
                    <div class="col" style="margin-top: 30px;" >
                        <label for="text" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="text" name="categorydesc"></textarea>
                    </div>
                </div>
                <div class="mb-3 row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="categoryprice">
                    </div>
                    <div class="col">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="number" class="form-control" id="duration" name="categoryduration">
                    </div>
                </div>

                <div class="mb-3 row" style="margin-top: 30px;">
                    <div class="col-6">
                        <label for="status-filter">Category:</label>
                        <select id="status-filter" name="selectcategory">
                        <?php foreach ($categoryvalue as $value): ?>
                            <option value="<?= $value['category_prefix'] . '|' . $value['category_ID'] ?>"><?= $value['category_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="picture">Choose a picture to upload:</label><br><br>
                        <input type="file" id="picture" name="categorypicture" accept="image/*" required><br><br>
                    </div>
                </div>
                <button type="submit" name="addservice" class="btn btn-primary" style="background-color: #6B4A4A; border-color: #6B4A4A;">Add</button>
            </form>
        </div>
    </div>

    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    
    </script>
</body>
</html>