<?php
$secret_key = "sk_test_miG9aeM2tHtsjzpCxRgaNwcp"; // Replace with your PayMongo secret key
$webhook_id = "hook_zMcYghwk1yhG51enB9boeX4E"; // Replace with your current webhook ID

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.paymongo.com/v1/webhooks/$webhook_id");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Basic " . base64_encode($secret_key . ":"),
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

echo "Webhook deleted: " . $response;
?>
