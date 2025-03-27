<?php

function getPaymentDetails($payment_intent_id) {
    $secret_key = "sk_test_miG9aeM2tHtsjzpCxRgaNwcp"; // Your secret key
    $url = "https://api.paymongo.com/v1/payment_intents/$payment_intent_id";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Basic " . base64_encode($secret_key . ":")
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response
    $response_data = json_decode($response, true);

    if (isset($response_data['data'])) {
        return $response_data['data']; // Return the payment intent details
    } else {
        return false; // Return false if not found
    }
}

// Example Usage:
$payment_intent_id = "pi_feUSjWJx6qM76QrBwafmLmvT"; // The ID you got earlier
$payment_details = getPaymentDetails($payment_intent_id);

if ($payment_details) {
    echo "Payment Status: " . $payment_details['attributes']['status'] . "<br>";
    echo "Amount: " . $payment_details['attributes']['amount'] / 100 . " PHP<br>"; // Amount is in cents
} else {
    echo "Payment Intent not found!";
}
