<?php

function getpaymentid($id){
        $secret_key = "sk_test_miG9aeM2tHtsjzpCxRgaNwcp"; // Replace with your actual secret key

        $url = "https://api.paymongo.com/v1/checkout_sessions/$id";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Basic " . base64_encode($secret_key . ":")
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        return $data['data']['attributes']['payments'][0]['id'];
    }

    // Replace with your actual Checkout Session ID
    //$checkout_id = "cs_T8ESScqHRgxwHFBQNDedjjnF";
    //$checkout_details = getPaymentIDFromCheckout($checkout_id);

    // Extract Payment ID
    //if (!empty($checkout_details['data']['attributes']['payments'])) {
    //    $payment_id = $checkout_details['data']['attributes']['payments'][0]; // The first payment ID
    //    echo "Payment ID: " . $payment_id;
    //} else {
    //    echo "No payment found for this checkout session.";



