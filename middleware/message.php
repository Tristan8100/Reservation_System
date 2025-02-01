<?php

if(isset($_GET['mess'])){
    $messval = $_GET['mess'];
}


?>

<?php if(isset($messval)): ?>

    <style>
        .messmodal{
            background-color: #ffccf2;
            border: 1px solid;
            border-radius: 10px;
            width: 500px;
            height: 300px;
            position: absolute;
            left: 50%;
            transform: translate(-50%, 20%);
            animation: fadeIn 0.3s ease-out forwards;
            -webkit-animation: fadeIn 0.3s ease-out forwards;
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

    <div class="messmodal"><?php echo $messval ?></div>

    <script>
        document.addEventListener('click', (event)=>{
            console.log('slooo');
            document.querySelector('.messmodal').style.display = "none";

            const url = new URL(window.location.href);
            url.searchParams.delete('mess'); // Remove the 'mes' parameter
            history.replaceState({}, '', url); 
        })
    </script>

<?php endif ?>

