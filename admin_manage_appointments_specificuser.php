<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_manage_appointment_specific_user</title>
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
                    Quick access to customer's appointment
                </div>
            </div>
            <div style="margin-left: auto;">
                <a href="admin_manage_account_all.php"><button style="background-color: #6B4A4A; width: 120px; color: white; border-radius: 10px;">Back</button></a>
            </div>
        </div>
    <!-- TEMPLATE -->

    <div class="modal-body">
        <div class="container" style="width: 250px; height: 250px; border: 1px solid #ccc;">
            <img src="images/user (3).png" class="img-fluid" alt="Responsive image">
    </div>
    <div>
                                                        
    </div>
    <div style="font-size: 25px; margin-left: 50%; transform: translate(-50%); text-align: center; color: black;">
        User00101
    </div>
    <div style="font-size: 15px; color: #828282; margin-left: 50%; transform: translate(-50%); text-align: center;">
        User00101@gmail.com
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Account ID
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            556603
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Name
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            LLOOOOM
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Phone Number
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            46468579358
        </div>
    </div>
    <br>
    <div class="border"></div>
    <br>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Reservation Type
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            Home Service
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Full Name
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            Loomiee
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Phone Number
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            46468579358
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Date/Time
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            12-25-24
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Address
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            Null
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Landmark
        </div>
        <div class="col-6" style="font-size: 25px; color: #828282; text-align: center;">
            Null
        </div>
    </div>
    <div class="row">
        <div class="col-6 d-flex justify-content-center align-items-center" style="font-size: 25px; padding-left: 30px; text-align: center; color: black;">
            Remarks
        </div>
        <div class="col-6" style="font-size: 15px; color: #828282; text-align: center;">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sodales urna vitae tincidunt condimentum. Etiam sit amet sodales ex. In lobortis lectus nunc, vel facilisis purus venenatis vitae. Duis mauris metus, aliquet vel quam finibus, feugiat dignissim lacus. In justo justo, facilisis vitae molestie eu, condimentum ut est. Etiam hendrerit id nisi sed varius. Proin interdum id massa vitae commodo. Pellentesque eu ultrices elit, ac maximus arcu. Phasellus eu arcu sed lectus volutpat interdum vehicula vel enim.
        </div>
    </div>
    </div>

    


        <div style="margin-top: 50px;">
            <div style="text-align: center; font-size: 30px;">Avail Services</div>
            <br>
            
            
            <div class="row">
            <div class="col-12">
                <!-- The Table -->
                <section class="intro">
                    <div class="bg-image h-100">
                        <div class="mask d-flex align-items-center h-100">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="table-responsive table-scroll" 
                                                    data-mdb-perfect-scrollbar="true" 
                                                    style="position: relative; height: 300px;">
                                                    <table class="table table-striped mb-0" 
                                                        style="table-layout: fixed; width: 100%;">
                                                        <thead style="background-color: #002d72;">
                                                            <tr>
                                                                <th scope="col">Service ID</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Price</th>
                                                                <th scope="col">Duration</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1285</td>
                                                                <td>tryasdgnsfjdksrhetwrhjeyksfjtsrhfhfkutlfkdfxjdykydxfhaerjtkfldgfyedfkgluguykdda@gmail.com</td>
                                                                <td>qwerty</td>
                                                                <td>Aaron Chapman</td>
                                                            </tr>
                                                            <tr>
                                                                <td>342</td>
                                                                <td>ayaya@gmail.com</td>
                                                                <td>ayyyayya</td>
                                                                <td>Kamisato Ayaya</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
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




    

            <br>
            <div style="text-align: center; font-size: 30px;">Add Therapist</div>
            <br>

            <div class="row">
                <div class="col-12">
                    <!-- The Table -->
                    <section class="intro">
                        <div class="bg-image h-100">
                            <div class="mask d-flex align-items-center h-100">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-12">
                                            <form action="" method="GET">
                                                <div class="card">
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive table-scroll" 
                                                            data-mdb-perfect-scrollbar="true" 
                                                            style="position: relative; height: 300px;">
                                                            
                                                            <table class="table table-striped mb-0" 
                                                                style="table-layout: fixed; width: 100%;">
                                                                <thead style="background-color: #002d72;">
                                                                    <tr>
                                                                        <th scope="col">Therapist ID</th>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">email</th>
                                                                        <th scope="col">add</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1285</td>
                                                                        <td>Neuvilette</td>
                                                                        <td>otter@gmail.com</td>
                                                                        <td><input type="radio" name="selected_row" value="1285"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>342</td>
                                                                        <td>ayaya</td>
                                                                        <td>ayyyayya@gmail.com</td>
                                                                        <td><input type="radio" name="selected_row" value="342"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit">Submit</button>
                                                <button type="submit">Cancel</button>
                                                <button type="submit">Ask customer to reassign</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>


    



    <?php include "adminsidebar/js_sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>