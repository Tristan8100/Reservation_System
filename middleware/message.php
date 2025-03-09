<?php

if(isset($_GET['mess'])){
    $messval = $_GET['mess'];
}


?>

<?php if(isset($messval)): ?>

    <style>
        .messmodal{
            background-color: #6b3702;
            border-radius: 10px;
            width: 400px;
            height: 250px;
            position: absolute;
            left: 50%;
            transform: translate(-50%, 20%);
            animation: fadeIn 0.3s ease-out forwards;
            -webkit-animation: fadeIn 0.3s ease-out forwards;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 1px 1px 10px;
            z-index: 100;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 20%);
            }
        }

        @keyframes fadeInOverlay {
            from { opacity: 0; }
            to   { opacity: 1; }
            }

            @-webkit-keyframes fadeInOverlay {
            from { opacity: 0; }
            to   { opacity: 1; }
            }

        /* Webkit-prefixed keyframes */
        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 20%);
            }
        }

        body{
            overflow: hidden;
        }
    </style>

    <div class="messmodal">
        <img style="height: 100px;" src="./images/logo.png" alt="./images/logo.png">
        <div style="border: 1px solid; border-color: #808080; width: 100%; margin-top: 10px;"></div>
        <div style="border: 1px solid; border-radius: 10px; width: 100%; height: 100%; background-color: white; display: flex; justify-content: center; align-items: center;">
            <div style="font-size: 30px; font-weight: 700;"><?php echo $messval ?></div>
        </div>
        
    </div>

    <script>
        document.addEventListener('click', (event)=>{
            console.log('slooo');
            document.querySelector('.messmodal').style.display = "none";
            document.querySelector('body').style.overflow = 'visible';

            const url = new URL(window.location.href);
            url.searchParams.delete('mess'); // Remove the 'mes' parameter
            history.replaceState({}, '', url); 
        })
    </script>

<?php endif ?>

