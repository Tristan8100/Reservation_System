<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accesshistory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include "side/css_dashboard.php"; ?>
    <style>
        body{
            background-color: #FFF0F0;
        }
        .pic0{
            width: 50px;
        }
        .main_content1{
            border: 1px solid;
            padding: 10px;
            width: 90%;
            margin-left: 8%;
        }
        .cont2{
            width: 300px;
            position: fixed;
        }

        .contr {
            display: none;
            left: 50%;
            transform: translateX(-50%);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
        }

        @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
        }
    </style>
</head>
<body>
    <div class="container-fluid heaad" style="border: 1px solid; z-index: 0; padding: 10px; height: 50px; position: absolute; top: 0%; width: 70%; margin-left: 120px;">
        <div style="font-size: 30px;">User Access History</div>
    </div>

    <img class="pic0" src="images/menu.png" style="margin-top: 10px;" >
    <?php include "side/sidebar.php"; ?>

    
    <div class="main_content1">

        <div style="border: 1px solid; padding: 10px; display:flex; justify-content:space-between; align-items: center;">
            <a style="background-color: #6B4A4A; color: white;" class="btn"  href="" >Add New</a>
        </div>

        <table class="table">
            <thead style="color: #FFF0F0;">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">View</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                <td>Ayayayaya</td>
                <td>09273859272</td>
                <td>12-23-24 9:25am</td>
                <td>Cancelled</td> <!-- put id based on user id as well as getpop -->
                <td><button class="btn tochh" id="11" style="background-color: #A1A1A1; color: white;">view</button></td>
                </tr>

                <div class="contr shadow" id="11" style="padding: 10px; width: 650px; border-radius: 10px; height: 400px; position: fixed; color: black; background-color: aliceblue;">
                    <div style="font-size: 20px;">Reservation type: Walk-in</div>
                    <div>Full Name: Ayayayayaya</div>
                    <div>Contact Number: 09273859272</div>
                    <div>Date & Time: 12-25-24 10:00:00 am</div>
                    <div>Address: Walk-in</div>
                    <div>Therapist: Lumineee</div>
                    <div>Remarks: AYAYAYAYAYAYAYA</div>
                </div>



                <!-- try area -->
                <tr>
                <td>Tim Henson</td>
                <td>09273859272</td>
                <td>12-23-24 9:25am</td>
                <td>Complete</td> <!-- put id based on user id as well as getpop -->
                <td><button class="btn tochh" id="12" style="background-color: #A1A1A1; color: white;">view</button></td>
                </tr>

                <div class="contr" id="12" style="border: 1px solid; padding: 10px; width: 650px; height: 400px; position: fixed; background-color: aliceblue;">12121aesdfg</div>

            </tbody>
        </table>

    </div>

    <?php include "side/js_sidebar.php"; ?>
    <script>
       //menuu 
        const heaad = document.querySelector('.heaad');
        const toc = document.querySelectorAll('.tochh');
        const contr = document.querySelectorAll('.contr');

        console.log(sidebar);
        function checckk(){
            heaad.style.marginLeft = '350px';
        }

        
        menuu.addEventListener('click', ()=> {
            checckk();
        })

        window.addEventListener('click', ()=> {
            event.stopPropagation();
            if(!sidebar.contains(event.target)){
                heaad.style.marginLeft = '120px';
            }

            if(!event.target.closest('.contr') && !event.target.closest('.tochh')){
                closeee();
            }
        })

        function controliterate(){
            //console.log('gee');
            contr.forEach(con => {
                if(event.target.id === con.id){
                    
                    con.style.display = 'block';
                }
            })
        }

        function closeee(){
            contr.forEach(con => {
                con.style.display = 'none';
            })
        }

        toc.forEach(to => {
            to.addEventListener('click', ()=>{
                closeee();
                controliterate();
            })
        })

        
        
      
    </script>
</body>
</html>