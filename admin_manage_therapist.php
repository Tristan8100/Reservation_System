<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_therapist</title>
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
                    Manage Therapist
                </div>
                <div style="color: #6B4A4A;">
                    Quick access to therapist
                </div>
            </div>
            <div style="margin-left: auto;">
                <a href=""><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Log Out</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

        <div class="container" style="color: #6B4A4A; margin-top: 30px; font-size: 25px;">Status</div>

        <div class="container" style="margin-top: 30px; display: flex;">
            <div style="width: 50%;">
                <div class="border" style="padding: 10px; width: 370px; border-radius: 10px; background-color: #FFFFFF;">
                    <div style="font-size: 30px; color: #6B4A4A;">20</div>
                    <div style="font-size: 25px; color: #6B4A4A;">Therapist</div>
                </div>
            </div>
            

            <div style="width: 50%;">
                <div class="border" style="padding: 10px; width: 370px; border-radius: 10px; background-color: #FFFFFF; margin-left: auto;">
                    <div style="font-size: 30px; color: #6B4A4A;">23</div>
                    <div style="font-size: 25px; color: #6B4A4A;">Booked Slots Today</div>
                </div>
            </div>
        </div>


        <div class="container" style="display: flex; align-items: center; margin-top: 50px;">
            <div>
                <div style="color: #6B4A4A; font-size: 30px; font-weight: 700; line-height: 36px; text-align: center; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Therapist Management Overview
                </div>
                <div style="color: #6B4A4A;">
                    Here’s a quick access to manage therapist
                </div>
            </div>
        </div>

        <div class="container">
            <div style="margin-top: 50px;">
                <div class="row">
                    <div class="col-4 border border-danger d-flex justify-content-center">
                        <a href="" style="text-decoration: none;">
                            <div class="shadow" style="width: 300px; height: 300px; border-radius: 10px; background-color: #FFFFFF;">
                                <div style="color: #6B4A4A; text-align: center; padding-top: 50px; font-weight: 700; font-size: 30px;">9</div>
                                <div style="color: #6B4A4A; text-align: center; font-size: 25px; font-weight: 700;">All Therapist</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 border border-danger d-flex justify-content-center">
                        <a href="" style="text-decoration: none;">
                            <div class="shadow" style="width: 300px; height: 300px; border-radius: 10px; background-color: #FFFFFF;">
                                <div style="color: #6B4A4A; text-align: center; padding-top: 50px; font-weight: 700; font-size: 30px;">Access</div>
                                <div style="color: #6B4A4A; text-align: center; font-size: 25px; font-weight: 700;">Booked Therapist</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 border border-danger d-flex justify-content-center">
                        <a href="" style="text-decoration: none;">
                            <div class="shadow" style="width: 300px; height: 300px; border-radius: 10px; background-color: #FFFFFF;">
                                <div style="color: #6B4A4A; text-align: center; padding-top: 50px; font-weight: 700; font-size: 30px;">Add Therapist</div>
                                <div style="width: 100px; height: 100px; margin-left: 50%; transform: translate(-50%);"><img src="images/adduser.png" alt="..." class="img-thumbnail"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    



    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script>
    
    </script>
</body>
</html>