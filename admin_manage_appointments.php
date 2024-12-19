<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_appointments</title>
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
                    Manage Appointments
                </div>
                <div style="color: #6B4A4A;">
                    Quick access to customer’s appointment
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
                    <div style="font-size: 30px; color: #6B4A4A;">7</div>
                    <div style="font-size: 25px; color: #6B4A4A;">Pending Appointments</div>
                </div>
            </div>
            
            <div style="width: 50%;">
                <a href="" style="text-decoration: none;">
                    <div class="border" style="padding: 10px; width: 370px; border-radius: 10px; background-color: #FFFFFF; margin-left: auto;">
                        <div style="font-size: 30px; color: #6B4A4A;">View all Appointments</div>
                        <div style="font-size: 25px; color: #6B4A4A;">Sort Appointments</div>
                    </div>
                </a>
            </div>

            <div style="width: 50%;">
                <div class="border" style="padding: 10px; width: 370px; border-radius: 10px; background-color: #FFFFFF; margin-left: auto;">
                    <div style="font-size: 30px; color: #6B4A4A;">3</div>
                    <div style="font-size: 25px; color: #6B4A4A;">Untracked Appointments</div>
                </div>
            </div>
        </div>


        <div class="container" style="display: flex; align-items: center; margin-top: 50px;">
            <div>
                <div style="color: #6B4A4A; font-size: 30px; font-weight: 700; line-height: 36px; text-align: center; text-underline-position: from-font; text-decoration-skip-ink: none;">
                    Upcoming Appointments
                </div>
                <div style="color: #6B4A4A;">
                    Here’s a quick access to upcoming appointments
                </div>
            </div>
        </div>

        <div style="margin-top: 50px;">
            <div class="row">
                <div class="col-9">

                <!-- The Table -->
                <section class="intro">
                <div class="bg-image h-100" style="background-color: #f5f7fa;">
                    <div class="mask d-flex align-items-center h-100">
                    <div class="container">
                        <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 500px">
                                <table class="table table-striped mb-0">
                                    <thead style="background-color: #002d72;">
                                    <tr>
                                        <th scope="col">Appointment ID</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="hidd" >1285</td>
                                        <td class="hidd">tryasdgnsfjdksrhetwrhjeyksfjtsrhfhfkutlfkdfxjdykydxfhaerjtkfldgfyedfkgluguykdda@gmail.com</td>
                                        <td class="hidd">qwerty</td>
                                        <td class="hidd">Aaron Chapman</td>
                                        <td class="hidd">1068358649358</td>
                                        <td class="hidd">10-12-23</td>
                                    </tr>
                                    <tr>
                                    <td class="hidd" >1285</td>
                                        <td class="hidd">lumine12356@gmail.com</td>
                                        <td class="hidd">loomloom</td>
                                        <td class="hidd">Lumieee</td>
                                        <td class="hidd">458935734257</td>
                                        <td class="hidd">11-12-24</td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                                </div>
                                <a href=""><button style="width: 100%; height: 40px; border-radius: 10px; background-color: #6B4A4A; color: white;">Show All</button></a>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                
                </section>
                <!-- The Table -->
                


                </div>
                <div class="col-3">

                <section class="intro">
                <div class="bg-image h-100" style="background-color: #f5f7fa;">
                    <div class="mask d-flex align-items-center h-100">
                    <div class="container">
                        <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 500px">
                                <table class="table table-striped mb-0">
                                    <thead style="background-color: #002d72;">
                                    <tr>
                                        <th scope="col" style="text-align: center;">New Accounts</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="hidd">tryasdgnsfjdksrhetwrhjeyksfjtsrhfhfkutlfkdfxjdykydxfhaerjtkfldgfyedfkgluguykdda@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td class="hidd">lumine12356@gmail.com</td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                                </div>
                                <a href=""><button style="width: 100%; height: 40px; border-radius: 10px; background-color: #6B4A4A; color: white;">Show All</button></a>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>

                </div>
            </div>
        </div>

    </div>
    



    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script>
    
    </script>
</body>
</html>