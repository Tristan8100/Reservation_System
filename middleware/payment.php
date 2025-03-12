<?php

session_start();

header('Content-Type: application/json');

if (isset($_SESSION['payment'])) {
    unset($_SESSION['payment']); // Avoid reusing old sessions
}

    // PayMongo Secret API Key
    $secret_key = "sk_test_miG9aeM2tHtsjzpCxRgaNwcp"; // Use sk_live_... when in live mode

    // API Endpoint for Checkout Session
    $url = "https://api.paymongo.com/v1/checkout_sessions";
    
    // Checkout Data
    $data = [
        "data" => [
            "attributes" => [
                "billing" => [
                    "name" => $_POST['username'],
                    "email" => $_POST['useremail']
                ],
                "send_email_receipt" => false,
                "show_description" => true,
                "show_line_items" => true,
                "cancel_url" => "https://localhost/reservation_system/user_dashboard.php?cancel",
                "description" => "for reservation fee",
                "line_items" => [
                    [
                        "currency" => "PHP",
                        "amount" => 10000,
                        "description" => "reservation fees",
                        "name" => "service reserve",
                        "quantity" => 1
                    ]
                ],
                "payment_method_types" => ["gcash"],
                "success_url" => "https://localhost/reservation_system/user_payment_choice.php?success"
            ]
        ]
    ];
    
    
    
    // Convert to JSON
    $json_data = json_encode($data);
    
    // cURL Request to PayMongo API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Basic " . base64_encode($secret_key . ":")
    ]);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Decode response
    $response_data = json_decode($response, true);
    
    // Redirect to Checkout URL if successful
    if (isset($response_data['data']['attributes']['checkout_url'])) {
        $session_id = $response_data['data']['id'];
        $_SESSION['payment'] = $session_id;
        echo json_encode([
        "status" => "success",
        "checkout_url" => $response_data['data']['attributes']['checkout_url']
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "response" => $response_data
        ]);
    }
    
    

?>