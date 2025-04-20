<?php

    include 'MVC/user_routes.php';

    require_once __DIR__ . '/middleware/encrypt_decrypt.php';

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


    


    if(isset($_POST['uploadimg'])){
        if (isset($_FILES['photoupload']) && $_FILES['photoupload']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['photoupload'];
            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageData = file_get_contents($imageTmpName);

            $control->uploadimgadmin($imageData, $userID);
        }
    }

    if(isset($_POST['sub1'])){
        if(password_verify($_POST['currpassword'], $user['user_password']) && $_POST['newpassword'] === $_POST['newpassword2']){
            $control->updatepassword2($_POST['newpassword'], $userID);
        } else {
            header('location: user_account_settings.php?mess='.encrypt("Password don't match or incorrect password"));
        }
    }

    if(isset($_POST['sub2'])){
        $control->updateinfo($_POST['fn'], $_POST['un'], $userID, $user['user_email']);
    }

 
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_account_settings</title>
    <?php require_once __DIR__ . '/adminsidebar/css_dashboard.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6B4A4A;
            --bg-color: #FFF0F0;
            --white: #FFFFFF;
        }
        
        body {
            background-color: var(--bg-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .pic0 {
            margin-top: 10px;
            width: 50px;
            cursor: pointer;
        }
        
        .main_content1 {
            padding: 20px;
            width: 90%;
            margin-left: 8%;
            max-width: 1200px;
        }
        
        .title {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .titlecont1 {
            color: var(--primary-color);
        }
        
        .titlecont2 {
            display: flex;
            align-items: center;
        }
        
        .account {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .desc {
            color: var(--primary-color);
            opacity: 0.8;
        }
        
        .logoutt {
            background-color: var(--primary-color);
            color: var(--bg-color);
            padding: 8px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .logoutt:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .inf {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 600;
            margin: 30px 0 20px;
        }
        
        .contimg {
            display: flex;
            align-items: center;
            gap: 20px;
            background: var(--white);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .clickpicc {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .clickpicc:hover {
            transform: scale(1.05);
        }
        
        .ov3 {
            color: var(--primary-color);
        }
        
        .ov3 div:first-child {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .chengeti {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 40px 0 10px;
        }
        
        .changecont {
            color: var(--primary-color);
            opacity: 0.8;
            margin-bottom: 20px;
        }
        
        .forforms {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 30px;
        }
        
        .forforms form {
            flex: 1;
            min-width: 300px;
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .forforms label {
            display: block;
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 8px;
            margin-top: 15px;
        }
        
        .forforms input[type="text"],
        .forforms input[type="number"],
        .forforms input[type="password"] {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s ease;
        }
        
        .forforms input:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .forforms input[type="submit"] {
            background-color: var(--primary-color);
            color: var(--bg-color);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        
        .forforms input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .somemodal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 500px;
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .ov1 {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .ov1 img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .ov2 {
            color: var(--primary-color);
            flex-grow: 1;
        }

        .ov2 div:first-child {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
            word-break: break-word;
        }
        
        
        /* media query */
        @media (max-width: 768px) {
            .main_content1 {
                width: 95%;
                margin-left: 5%;
                padding: 15px;
            }
            
            .contimg {
                flex-direction: column;
                text-align: center;
            }
            
            .ov1 {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .titlecont1, .titlecont2 {
                width: 100%;
                text-align: center;
                margin-bottom: 15px;
            }
            
            .titlecont2 {
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .account {
                font-size: 1.5rem;
            }
            
            .inf, .chengeti {
                font-size: 1.2rem;
            }
            
            .clickpicc {
                width: 80px;
                height: 80px;
            }
            
            .forforms {
                gap: 20px;
            }
            
            .forforms form {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>

    <img class="pic0" src="images/menu.png" alt="Menu">
    <?php require_once __DIR__ . '/adminsidebar/sidebar.php'; ?>

    <div style="display:flex; justify-content:center;">
    <div class="somemodal">
        <div class="ov1">
            <img src="<?php echo disp($user); ?>" class="rounded d-block" style="width:100px;">
            
            <div class="ov2">
                <div style="font-size: 30px; margin-bottom:-10px; overflow: hidden; text-overflow: ellipsis;">
                    <?php echo $user['user_fullname'] ?>
                </div>
                <div>
                    <?php echo $user['user_email'] ?>
                </div>
            </div>
        </div>

        <form action="admin_account_settings.php" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
            <label for="photo">Upload Photo:</label>
            <input type="file" id="photo" name="photoupload" accept="image/*" required><br><br>

            <input type="submit" name="uploadimg" value="Upload" class="btn mt-2" style="background-color: #6B4A4A; color: white;">
        </form>
        </div>
    </div>

    <div class="main_content1">
        <div class="title">
            <div class="titlecont1">
                <div class="account">
                    Account Settings
                </div>
                <div class="desc">
                    Quick access to account settings
                </div>
            </div>
            <div class="titlecont2">
                <a href="user_dashboard.php" class="btn logoutt">Back</a>
            </div>
        </div>
        
        <div class="inf">
            Your Info
        </div>
        
        <div class="contimg">
            <div>
                <img src="<?php echo disp($user); ?>" class="rounded d-block clickpicc" alt="Profile Picture">
            </div>
            <div class="ov3">
                <div style="font-size: 30px; margin-bottom:-10px;">
                    <?php echo $user['user_fullname'] ?>
                </div>
                <div>
                    <?php echo $user['user_email'] ?>
                </div>
            </div>
        </div>

        <div class="changeacc">
            <div class="chengeti">Change Account Information</div>
            <div class="changecont">Here's a quick access to account information</div>
        </div>

        <div class="forforms" style="color: #6B4A4A;">
            <form action="admin_account_settings.php" method="POST">
                <div>
                    <label for="pass">Current Password:</label>
                    <input type="password" id="pass" name="currpassword" required>

                    <label for="passnew">New Password:</label>
                    <input type="password" id="passnew" name="newpassword" required>

                    <label for="passnewconf">Confirm Password:</label>
                    <input type="password" id="passnewconf" name="newpassword2" required>

                    <input type="submit" name="sub1" value="Update Password" class="btn mt-2" style="background-color: #6B4A4A; color: white;">
                </div>
            </form>

            <form action="admin_account_settings.php" method="POST">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="fn" value="<?php echo $user['user_fullname'] ?>" required>

                    <label for="addnum">Add Number</label>
                    <input type="number" id="addnum" name="un" value="<?php echo $user['user_number'] ?>" required>

                    <input type="submit" name="sub2" value="Update Profile" class="btn" style="background-color: #6B4A4A; color: white;">
                </div>
            </form>
        </div>
    </div>


    <?php require_once __DIR__ . '/adminsidebar/js_sidebar.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        
        const picclick = document.querySelector('.clickpicc');
        const somemodall = document.querySelector('.somemodal');

        console.log(somemodall.children[0]);

        document.addEventListener('click', picclickedd)

        function picclickedd(){
            console.log(event.target);
            if(event.target === picclick && somemodall.style.display === 'none'){
                somemodall.style.display = 'block';
            } else if(!somemodall.contains(event.target)) {
                somemodall.style.display = 'none';
            }
        }
    </script>
    
</body>
</html>