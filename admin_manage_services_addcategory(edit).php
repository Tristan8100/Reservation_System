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
    if(isset($_POST['categoryedit'])){
        //execute the edit
        $_POST['categoryname'];
        $_POST['categoryprefix'];
        $categorycontrol->editcategory($_POST['categoryname'], $_POST['categoryprefix'], $_POST['categoryid'] );
    }



    //to catch if no value
    if(isset($_GET['edit'])){
        $val1 = $categorycontrol->fetchonecategory($_GET['edit']);
    }
    

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_services_addcategory</title>
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
                    Edit Category
                </div>
            </div>
            <div style="margin-left: auto;">
                <a href="admin_manage_services.php"><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Back</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

    <div class="container border border-danger d-flex justify-content-center" style="margin-top: 30px;">
        <div class="shadow" style="background-color: #FFFFFF; padding: 20px; width: 500px; height: 400px; border-radius: 10px;">
            <form action="admin_manage_services_addcategory(edit).php" method="POST" style="display: flex; flex-direction: column;">
                <div style="color: #6B4A4A; text-align: center; font-weight: 600; font-size: 30px; margin-top: 30px;">Edit Category</div>
                <div class="mb-3 row">
                <input type="hidden" class="form-control" id="idd" value="<?php echo $val1['category_ID'] ?>" name="categoryid" required>
                    <div class="col" style="margin-top: 30px;">
                        <label for="sname" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="sname" value="<?php echo isset($val1['category_name']) ? $val1['category_name'] : ''; ?>"
                        name="categoryname" required>
                    </div>
                    <div class="col" style="margin-top: 30px;" >
                        <label for="text" class="form-label">prefix</label>
                        <input type="text" class="form-control" id="sname1" value="<?php echo isset($val1['category_prefix']) ? $val1['category_prefix'] : ''; ?>"
                        name="categoryprefix" required>
                    </div>
                </div>

                <div class="mb-3" style="margin-top: 30px;">

                </div>
                <button type="submit" name="categoryedit" class="btn btn-primary" style="background-color: #6B4A4A; border-color: #6B4A4A;">Edit</button>
            </form>
        </div>
    </div>

    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    
    </script>
</body>
</html>