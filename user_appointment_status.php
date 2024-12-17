<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>appointmentstatus</title>
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
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" style="margin-top: 10px;" >
    <?php include "side/sidebar.php"; ?>

    <div class="main_content1">

        <div style="border: 1px solid; padding: 10px; display:flex; justify-content:space-between; align-items: center;">
            <div>
                Add New
            </div>
            <a style="background-color: #6B4A4A; color: white;" class="btn"  href="" >Add New</a>
        </div>

        <table class="table">
            <thead style="color: #FFF0F0;">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                <td>Tim Henson</td>
                <td>09273859272</td>
                <td>12-23-24 9:25am</td>
                <td>Pending</td> <!-- put id based on user id as well as getpop -->
                <td><button class="btn toch" id="11" style="background-color: #A1A1A1; color: white;">view</button></td>
                </tr>

                                  <!-- HERE -->
                <div style="border: 1px solid; display: flex; justify-content:center;">
                <div id="11" class="card cont2 shadow p-3 getpop" style="margin-top: -80px; display: none;">
                        <form class="forr">
                            <div class="textabove" style="font-size: 30px; font-weight: 500; text-align: center;">
                                Your Appointment1
                            </div>
                            <br>
                        <div class="nme">
                            <label>Full Name</label>
                                <br>
                                <input type="text" class="fil" style="border: 1px solid; width: 100%; ">
                                <br><br>
                                <label>Contact Number</label>
                                <br>
                                <input type="text" class="fil" style="border: 1px solid; width: 100%; ">
                                <br><br>

                                <label for="datetime">Select Date and Time:</label>
                                <br>
                                <input style="width: 100%;" class="fil" type="datetime-local" id="datetime" name="datetime">
                                <br><br>
                                
                                <label>Address</label>
                                <br>
                                <input type="text" class="fil" style="border: 1px solid; width: 100%; ">
                                <br><br>

                                <label>Landmark</label>
                                <br>
                                <input type="text" class="fil" style="border: 1px solid; width: 100%; ">
                                <br><br>

                                <div>Choose Therapist:</div>
                                <input type="radio" name="gender" value="male">
                                <label>Male</label><br>

                                <input type="radio" name="gender" value="female">
                                <label>Female</label><br><br>

                                <label>Remarks</label>
                                <br>
                                <textarea style="width: 100%; height: 150px;"></textarea>
                                <br><br>

                                <input style="width: 100%; height: 40px; background-color: #6B4A4A; color:white; border-radius:10px;" type="submit">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- try area -->
                <tr>
                <td>Tim Henson</td>
                <td>09273859272</td>
                <td>12-23-24 9:25am</td>
                <td>Pending</td> <!-- put id based on user id as well as getpop -->
                <td><button class="btn toch" id="12" style="background-color: #A1A1A1; color: white;">view</button></td>
                </tr>

                                  <!-- HERE -->
                <div style="border: 1px solid; display: flex; justify-content:center;">
                <div id="12" class="card cont2 shadow p-3 getpop" style="margin-top: -80px; display: none;">
                        <form class="forr">
                            <div class="textabove" style="font-size: 30px; font-weight: 500; text-align: center;">
                                Your Appointment
                            </div>
                            <br>
                        <div class="nme">
                            <label>Full Name</label>
                                <br>
                                <input type="text" class="fil" style="border: 1px solid; width: 100%; ">
                                <br><br>
                                <label>Contact Number</label>
                                <br>
                                <input type="text" class="fil" style="border: 1px solid; width: 100%; ">
                                <br><br>

                                <label for="datetime">Select Date and Time:</label>
                                <br>
                                <input style="width: 100%;" class="fil" type="datetime-local" id="datetime" name="datetime">
                                <br><br>
                                
                                <label>Address</label>
                                <br>
                                <input type="text" class="fil" style="border: 1px solid; width: 100%; ">
                                <br><br>

                                <label>Landmark</label>
                                <br>
                                <input type="text" class="fil" style="border: 1px solid; width: 100%; ">
                                <br><br>

                                <div>Choose Therapist:</div>
                                <input type="radio" name="gender" value="male">
                                <label>Male</label><br>

                                <input type="radio" name="gender" value="female">
                                <label>Female</label><br><br>

                                <label>Remarks</label>
                                <br>
                                <textarea style="width: 100%; height: 150px;"></textarea>
                                <br><br>

                                <input style="width: 100%; height: 40px; background-color: #6B4A4A; color:white; border-radius:10px;" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
    <!-- End of try area -->

            </tbody>
        </table>

    </div>

    <?php include "side/js_sidebar.php"; ?>
    <script>
        const tochh = document.querySelectorAll('.toch');
        const popppi = document.querySelectorAll('.getpop');

        tochh.forEach(toccc =>{
            toccc.addEventListener('click', ()=>{
                event.stopPropagation()
                closeee();
                popppi.forEach(poss => {
                    if(event.target.id === poss.id){
                        console.log('here');
                        if(poss.style.display === 'none'){
                        poss.style.display = 'block';
                        }
                    }
                })
                
            })
        })

        function closeee(){
            popppi.forEach(popp =>{
                popp.style.display = 'none';
            })
        }

        document.addEventListener('click', ()=>{
            console.log(event.target);
            if(event.target.closest('.getpop')){
                console.log('catchh');
            } else {
                closeee();
            }
            
            
        })

      
    </script>
</body>
</html>