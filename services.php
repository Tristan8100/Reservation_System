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
    <style>
        .mod {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 500px; 
            background-color: #FFFFFF;
            border-radius: 10px;
            border: 1px solid;
            display: none;
        }

    </style>
</head>
<body>
    <div class="container-fluid" style="height: 200px; background-color: #131313;">
        <div class="" style="width: 100%; height: 100%;">
            <div style="margin-left: 100px;">
                <div style="color: #FF0000; font-size: 100px; font-weight: 100; line-height: 121.18px; letter-spacing: 0.06em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    D&E
                </div>
                <div style="color: #FFFFFF; width: 250px; font-size: 20px; font-weight: 200; line-height: 24.24px; letter-spacing: 0.06em; text-align: left; text-decoration-line: underline; text-decoration-style: solid; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Home and Hotel Massage Service
                </div>
            </div>
            
            <div class="" style="margin-left: auto; margin-top: -160px; width: 300px;">
                <img src="images/logo.png" style="width: 170px; height: 170px; top: 6px; left: 1170px; gap: 0px; opacity: 0px;">
            </div>
        </div>

    </div>

    <div class="container" style="padding: 10px;">
        <div>
            <div style="display: flex; margin-top: 20px;">
                <div style="border-left: 5px solid; color: #AC1515; height: 45px; margin-top: 5px; "></div>
                <div style="margin-left: 10px; font-family: Inter; font-size: 45px; font-weight: 500; line-height: 54.53px; letter-spacing: 0.06em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Services:
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: -40px;">
                <a onclick="window.history.back()">
                    <button style="width: 124px; background-color: #6B4A4A66; border: none; color:rgba(61, 45, 45, 0.97); height: 33px; top: 214px; left: 1209px; gap: 0px; border-radius: 10px; opacity: 0px;"><- Back</button>
                </a>
            </div>
        </div>
    </div>

    <div class="container border border-danger" style="margin-top: 30px;"></div>

    
    <div class="container border border-primary" style="margin-top: 50px;  display: grid;
  grid-template-columns: auto auto auto;">
        <?php foreach($service as $serve): ?>
            <div class="grid-item" style="border: 1px solid; display: flex; justify-content: center;">
            <div class="card tog" id="1234" style="width: 18rem;">
                <div style="height: 200px; overflow: hidden;">
                    <img class="card-img-top" src="<?php echo displayimg($serve['service_image']); ?>" alt="Card image cap" style="height: 100%; width: auto; object-fit: cover;">
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $serve['service_name']; ?></p>
                    <p class="card-text"><?php echo $serve['service_price']; ?></p>
                    <p class="card-text"><?php echo $serve['service_duration']; ?></p>
                </div>
            </div>
            <div class="mod" id="1234"></div>
        </div>

        <?php endforeach ?>
        <div class="grid-item" style="border: 1px solid; display: flex; justify-content: center;">Item 2</div>
        <div class="grid-item" style="border: 1px solid; display: flex; justify-content: center;">Item 3</div>
    </div>

    

   
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        
        const togglemodal = document.querySelectorAll('.tog');
        const modd = document.querySelectorAll('.mod');
        
        togglemodal.forEach((modal) =>{
            modal.addEventListener('click', (event)=>{
                event.stopPropagation();
                closeall();
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
            } else if(event.target.closest('.tog')){
                modd.forEach((mods) =>{
                    if(event.target.closest('.tog').id === mods.id){
                            if(mods.display === "none"){
                                console.log('okkk');
                            } else if(mods.display === "block") {
                                closeall();
                            }
                        }
                    })
            } else {
                closeall();
            }
        })

    </script>
</body>
</html>