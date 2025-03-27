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

    function displayimg($use){
        if (!empty($use)) {
            return 'data:image/jpeg;base64,' . base64_encode($use);
        } else {
            return "images/adduser.png"; // Default image
        }
    }

    $service = $servicecontrol->fetchallservice();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <head>
    <style>
        body {
            background-color: #FFF0F0;
        }

        .mod {
            position: fixed;
            top: 50%;
            left: 50%;
            z-index: 9999;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 600px;
            height: auto;
            background-color: #FFFFFF;
            border-radius: 10px;
            display: none;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .no-scroll {
            overflow: hidden;
        }

        .header {
            height: 200px;
            background-color: #131313;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .logo {
            color: #FF0000;
            font-size: 80px;
            font-weight: 100;
        }

        .subtitle {
            color: #FFFFFF;
            font-size: 20px;
            text-decoration: underline;
        }

        .logo-img {
            width: 120px;
            height: auto;
        }

        .services-header {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .services-header div:first-child {
            border-left: 5px solid #AC1515;
            height: 45px;
            margin-right: 10px;
        }

        .services-header h2 {
            font-size: 35px;
            font-weight: 500;
        }

        .back-button {
            display: flex;
            justify-content: flex-end;
            margin-top: -40px;
        }

        .back-button button {
            width: 124px;
            background-color: #6B4A4A66;
            border: none;
            color: rgba(61, 45, 45, 0.97);
            height: 33px;
            border-radius: 10px;
            cursor: pointer;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            width: 100%;
            max-width: 18rem;
            margin: auto;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .modal-content img {
            width: 100%;
            max-width: 500px;
            height: auto;
        }
        @media (max-width: 768px) {
            .logo {
                font-size: 50px;
            }
            .subtitle {
                font-size: 16px;
            }
            .logo-img {
                width: 120px;
                height: 120px;
            }
            
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <div class="logo">D&E</div>
            <div class="subtitle">Home and Hotel Massage Service</div>
        </div>
        <img src="images/logo.png" class="logo-img">
    </div>

    <div class="container">
        <div class="services-header">
            <div></div>
            <h2>Services:</h2>
        </div>

        <div class="back-button">
            <a onclick="window.history.back()">
                <button>&larr; Back</button>
            </a>
        </div>
    </div>

    <div class="container services-grid">
        <?php foreach($service as $serve): ?>
            <div class="grid-item">
                <div class="card tog" id="<?php echo $serve['service_ID']; ?>">
                    <img src="<?php echo displayimg($serve['service_image']); ?>" alt="Service Image">
                    <div class="card-body">
                        <p class="d-flex justify-content-center" style="font-size: 25px; font-weight: 500;"> <?php echo $serve['service_name']; ?> </p>
                        <p class="d-flex justify-content-center" style="font-size: 20px; font-weight: 400;"> ₱<?php echo $serve['service_price']; ?> </p>
                        <p class="d-flex justify-content-center" style="font-size: 20px; font-weight: 400;"> <?php echo $serve['service_duration']; ?> minutes </p>
                    </div>
                </div>
                <div class="mod shadow" id="<?php echo $serve['service_ID']; ?>">
                    <img src="<?php echo displayimg($serve['service_image']); ?>" class="img-thumbnail rounded mx-auto d-block">
                    <div class="d-flex justify-content-center" style="font-size: 30px; font-weight: 500;"> <?php echo $serve['service_name']; ?> </div>
                    <div class="d-flex justify-content-center" style="font-size: 25px;"> ₱<?php echo $serve['service_price']; ?> </div>
                    <div class="d-flex justify-content-center" style="font-size: 25px;"> <?php echo $serve['service_duration']; ?> minutes</div>
                    <div style="padding: 10px; height: 150px; overflow: auto;" class="border">
                        <div class="d-flex justify-content-center" style="font-size: 20px; text-align: center;"> <?php echo $serve['service_description']; ?> </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</body>

    

   
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        
        const togglemodal = document.querySelectorAll('.tog');
        const modd = document.querySelectorAll('.mod');
        
        togglemodal.forEach((modal) =>{
            modal.addEventListener('click', (event)=>{
                event.stopPropagation();
                closeall();
                document.body.classList.add('no-scroll');
                if(event.target.closest('.tog')){
                    console.log('catched');
                    modd.forEach((mods) =>{
                        console.log(mods.id);
                    if(event.target.closest('.tog').id === mods.id){
                        mods.style.display = "block";
                        }
                    })
                }
            })
        })

        function closeall(){
            modd.forEach((mods) =>{
                mods.style.display = "none";
            })
        }

        document.addEventListener('click', ()=>{
            event.stopPropagation();
            if(event.target.closest('.mod')){
                    console.log('succes mod');
            } else {
                document.body.classList.remove('no-scroll');
                closeall();
            }
        })

    </script>
</body>
</html>