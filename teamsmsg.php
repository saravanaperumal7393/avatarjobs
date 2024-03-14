<?php
// Webhook URL obtained from Microsoft Teams
$webhookUrl = 'YOUR_WEBHOOK_URL';

// Message to be sent
$message = [
    'text' => 'This is a notification from PHP to Microsoft Teams!'
];

// Convert message to JSON
$payload = json_encode($message);

// Set cURL options
$ch = curl_init($webhookUrl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload)
]);

// Execute cURL request
$result = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Output result (if needed)
var_dump($result);
?>
