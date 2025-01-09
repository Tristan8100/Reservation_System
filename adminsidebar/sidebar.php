<div class="sidebar">
            <div class="upper">
                <div class="upper1">
                    <img class="upperpic" src="<?php echo disp($user); ?>">
                    <div class="uppertext_container">
                        <div class="uppertext">
                            <?php echo $user['user_fullname']; ?> <!-- declare $user as a new object -->
                        </div>
                        <div class="uppertext_gmail">
                            <?php echo $user['user_email']; ?>
                        </div>
                    </div>
                </div>
                <a href="" class="logout">
                        Log out
                </a>
            </div>
            <div class="separate"></div>

            <div class="bodysidebar">
                <a class="options" href="admin_dashboard.php">
                    <img class="img11" src="images/user1.png">
                    Admin Dashboard
                </a>
                <a class="options" href="admin_account_settings.php">
                    <img class="img11" src="images/settings.png">
                    Admin Settings
                </a>
                <a class="options" href="admin_manage_account.php" style="font-size: 20px;">
                    <img class="img11" src="images/manageacc.png">
                    Manage Accounts
                </a>
                <a class="options" href="admin_manage_appointments.php">
                    <img class="img11 popi" src="images/appoint.png">
                    Manage Appointments
                </a>
                <a class="options" href="admin_manage_therapist.php">
                    <img class="img11 popi" src="images/therapistslot.png">
                    Therapist
                </a>
                <a class="options" href="admin_manage_services.php">
                    <img class="img11 popi" src="images/message.png">
                    Services
                </a>
                
            </div>
        </div>
