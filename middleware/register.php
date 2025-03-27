<?php

$secret_key = "sk_test_miG9aeM2tHtsjzpCxRgaNwcp"; // Replace with your PayMongo secret key

$webhook_url = "https://localhost/reservation_system/middleware/webhook.php"; // Replace with your actual webhook URL

$data = [
    "data" => [
        "attributes" => [
            "url" => $webhook_url,
            "events" => ["payment.paid", "payment.failed"] // List of events PayMongo should send to your webhook
        ]
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.paymongo.com/v1/webhooks");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Basic " . base64_encode($secret_key . ":"),
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($response, true);
print_r($response_data); // Displays webhook registration response

?>
