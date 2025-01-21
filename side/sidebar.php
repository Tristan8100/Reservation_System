<div class="sidebar">
            <div class="upper">
                <div class="upper1">
                    <img class="upperpic" src="<?php echo disp($user); ?>">
                    <div class="uppertext_container">
                        <div class="uppertext">
                            <?php echo $variable = isset($user['user_fullname']) ? $user['user_fullname'] : "no info"; ?>
                        </div>
                        <div class="uppertext_gmail">
                            <?php echo $variable = isset($user['user_email']) ? $user['user_email'] : "no info"; ?>
                        </div>
                    </div>
                </div>
                <a href="" class="logout">
                        Log out
                </a>
            </div>
            <div class="separate"></div>

            <div class="bodysidebar">
                <a class="options" href="user_dashboard.php">
                    <img class="img11" src="images/user1.png">
                    User Dashboard
                </a>
                <a class="options" href="user_account_settings.php">
                    <img class="img11" src="images/settings.png">
                    Edit Profile
                </a>
                <a class="options" href="user_access_history.php">
                    <img class="img11" src="images/transact.png">
                    History
                </a>
                <div class="options" href="">
                    <img class="img11 popi" src="images/appoint.png">
                    Appointment
                </div>
                <div class="poppp" style="display: none;" >
                    <a class="options" href="user_homeserv_form.php">
                        <img class="img11" src="images/appoint.png">
                        Home Service
                    </a>
                    <a class="options" href="user_walkin_form.php">
                    <img class="img11" src="images/appoint.png">
                        Walk In
                    </a>
                    <a class="options" href="user_appointment_status.php">
                    <img class="img11" src="images/appoint.png">
                        Appointment Status
                    </a>
                </div>
            </div>
        </div>
