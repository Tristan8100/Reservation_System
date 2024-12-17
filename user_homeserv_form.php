<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home_service</title>
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
            display: flex;
            justify-content: center;
        }
        .cont2{
            width: 500px;
        }
        .forr{
            padding: 10px;
        }
        .fil{
            border-radius: 5px;
            height: 40px;
        }
    </style>
</head>
<body>
    <img class="pic0" src="images/menu.png" style="margin-top: 10px;" >
    <?php include "side/sidebar.php"; ?>

    <div class="main_content1">
        <div class="card cont2 shadow p-3">
            <form class="forr">
                <div class="textabove" style="font-size: 30px; font-weight: 500; text-align: center;">
                    Book Your Appointment
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

    <?php include "side/js_sidebar.php"; ?>
</body>
</html>