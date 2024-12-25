<?php

    include 'MVC/user_routes.php';

    if(!isset($_SESSION['user_id']) && $_SESSION['user_role'] !== 'USER'){
        header('location: login_form.php');
        exit;
    } else {
        $userID = $_SESSION['user_id'];
    }

    
    $user = $control->selectoneuser($userID);
    //var_dump($user);
    if(isset($_POST['uploadimg'])){
        if (isset($_FILES['photoupload']) && $_FILES['photoupload']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['photoupload'];
            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageData = file_get_contents($imageTmpName);

            $control->uploadimg($imageData, $userID);
        }
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_account_settings</title>
    <?php include 'side/css_dashboard.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFF0F0;
        }
        .pic0 {
            margin-top: 10px;
            width: 50px;
        }
        .main_content1 {
            border: 1px solid;
            padding: 10px;
            width: 90%;
            margin-left: 8%;
        }

        .title{
            display: flex;
        }
        .titlecont1{
            width: 50%;
            color:#6B4A4A;
        }
        .titlecont2{
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: end;
        }

        .contimg{
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .forforms{
            padding: 10px;
            margin-top: 50px;
        }
        .somemodal{
            padding: 10px;
            width: 400px;
            background-color: white;
            position: fixed;
        }
        

        .ov1{
            display: grid;
            grid-template-columns:50% 50%;
        }
        .ov2{
            margin-left:20px; color:#6B4A4A;
        }
        .account{
            font-weight:600;
            font-size:30px;
        }
        .logoutt{
            background-color:#6B4A4A;
            color:#FFF0F0;
            padding-left:20px;
            padding-right:20px;
        }
        .inf{
            color:#6B4A4A;
            font-size: 20px;
            font-weight:600;
            padding-top: 30px;
        }
        .clickpicc{
            width:100px;
        }
        .ov3{
            margin-left:20px;
            color:#6B4A4A
        }
        .chengeti{
            font-size: 25px;
            font-weight:600;
            color:#6B4A4A;
            margin-top: 50px;
        }
        .changecont{
            width:250px;
            color:#6B4A4A;
        }
        .ov4{
            display: grid;
            grid-template-columns:auto auto;
        }
    </style>
</head>
<body>

        <img class="pic0" src="images/menu.png">
        <?php include 'side/sidebar.php' ?>

        <div style="display:flex; justify-content:center;">
            <div class="somemodal" style="display: none; border-radius: 10px; padding: 10px; border: 1px solid;">
                <div class="ov1">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['user_image']); ?>" class="rounded d-block" style="width:100px;">
                    
                    <div class="ov2">
                        <div style="font-size: 30px; margin-bottom:-10px; overflow: hidden; text-overflow: ellipsis; ">
                            <?php echo $user['user_fullname'] ?>
                        </div>
                        <div>
                            <?php echo $user['user_email'] ?>
                        </div>
                    </div>

                    <form action="user_account_settings.php" method="POST" enctype="multipart/form-data">
                    <label for="photo">Upload Photo:</label>
                    <input type="file" id="photo" name="photoupload" accept="image/*" required><br><br>

                    <input type="submit" name="uploadimg">
                    </form>

                </div>
            </div>
        </div>



        <div class="main_content1">
            <div class="title">
                <div class="titlecont1" >
                    <div class="account">
                        Account Settings
                    </div>
                    <div class="desc">
                        Quick access to account settings
                    </div>
                </div>
                <div class="titlecont2" style="margin-left: auto;">
                    <a href="" class="btn logoutt" >Log-out</a>
                </div>
            </div>
            <div class="inf">
                Your Info
            </div>
            <div class="contimg">
                <div>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['user_image']); ?>" class="rounded d-block clickpicc">
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
                <div class="changeti">Change Account Information</div>
                <div class="changecont">Here’s a quick access to account information</div>
            </div>

            <div class="forforms" style="color: #6B4A4A;">
                <form class="ov4">
                    <div style="padding: 10px;">
                        <label for="pass">Current Password:</label> <br>
                        <input type="text" id="pass" name="password" required> <br>

                        <label for="passnew">New Password:</label> <br>
                        <input type="text" id="passnew" name="newpassword" required> <br>

                        <label for="passnewconf">Confirm Password:</label> <br>
                        <input type="text" id="passnewconf" name="confirmnewpassword" required> <br>
                    </div>
                    <div style="padding:10px;">
                    <label for="username">Username:</label> <br>
                        <input type="text" id="username" name="username" required> <br>

                        <label for="email">Enter Email</label> <br>
                        <input type="text" id="email" name="email" required> <br>

                        <label for="addnum">Add Number</label> <br>
                        <input type="text" id="addnum" name="addnum" required> <br>
                    </div>

                    <input type="submit" name="sub" value="Submit" class="btn" style="background-color: #6B4A4A; width:200px; color: white;">
                </form>
            </div>
        </div>


        <?php include 'side/js_sidebar.php' ?>
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