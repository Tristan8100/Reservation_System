<?php

require_once __DIR__ . '/encrypt_decrypt.php';

if(isset($_GET['mess'])){
    $messval = decrypt($_GET['mess'], $secretkey);
    //if(!$messval){
    //    $messval = $_GET['mess'];
    //}
}


?>

<?php if(!empty($messval)): ?>

    <style>
        /* Core modal structure (unchanged class) */
    .messmodal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 340px;
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        z-index: 1000;
        animation: modalFadeIn 0.4s ease-out;
        border-top: 5px solid transparent; /* Color set by status */
    }

    /* Your logo styling */
    .modal-logo {
        height: 60px;
        margin-bottom: 20px;
        object-fit: contain;
    }

    /* Status icon (dynamic ✓ or ✗) */
    .modal-status-icon {
        font-size: 50px;
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.05);
        animation: iconBounce 0.6s;
    }

    /* Message text */
    .modal-message {
        font-size: 18px;
        color: #333;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    /* Close button */
    .modal-close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 22px;
        color: #999;
        cursor: pointer;
        transition: all 0.2s;
    }

    /* Color coding for statuses */
    .messmodal[data-status="success"] {
        border-top-color: #4CAF50;
    }
    .messmodal[data-status="success"] .modal-status-icon {
        color: #4CAF50;
    }

    .messmodal[data-status="error"] {
        border-top-color: #F44336;
    }
    .messmodal[data-status="error"] .modal-status-icon {
        color: #F44336;
    }

    /* Animations */
    @keyframes modalFadeIn {
        from { opacity: 0; transform: translate(-50%, -45%); }
    }

    @keyframes iconBounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

        body{
            overflow: hidden;
        }
    </style>

    <div class="messmodal" <?php if(stripos($messval, 'success') !== false): ?> data-status="success" <?php else: ?> data-status="error" <?php endif ?>> <!-- or "error" -->
    <!-- Logo stays exactly where you had it -->
    <img class="modal-logo" src="./images/logo.png" alt="Your Logo">
    
    <!-- Status icon appears above message -->
    <div class="modal-status-icon">
        <?php if(stripos($messval, 'success') !== false): ?>
            <div data-status="success">✓</div>
        <?php else: ?>
            <div data-status="error">✗</div>
        <?php endif; ?>
    </div>

    <!-- Message container (your PHP variable stays) -->
    <div class="modal-message"><?php echo $messval ?></div>
    
    <!-- Optional close button -->
    <button class="modal-close-btn">&times;</button>
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

