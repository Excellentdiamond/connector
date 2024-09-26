<?php
// Replace 'YOUR_API_TOKEN' with your actual Telegram bot token
$token = '7493932821:AAGamFZLLlEgI0b0PxsiRVdIREG3nC1hrOg';
$telegramApiUrl = "https://api.telegram.org/bot$token";

// Replace 'YOUR_CHAT_ID' with your actual Telegram chat ID
$chatId = '5980124239';

// Function to send a message via Telegram Bot API
function sendMessage($chatId, $text) {
    global $telegramApiUrl;
    $url = $telegramApiUrl . "/sendMessage";
    $data = array('chat_id' => $chatId, 'text' => $text);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        die('Error sending message');
    }
}

// Check if 'message' query parameter is present
if (!isset($_GET['message'])) {
    http_response_code(400);
    echo 'Message query parameter is required.';
    exit();
}

$message = $_GET['message'];
sendMessage($chatId, $message);
echo 'Message sent to Telegram!';
?>
