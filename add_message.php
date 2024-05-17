<?php

$logDirectory = 'logs/';


function logActivity($message, $chatId) {
    global $logDirectory;
    $logFile = $logDirectory . $chatId.'.txt';
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $logMessage = "[$ipAddress] $message\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

$directory = 'data/';
$chatId = isset($_GET['chat-id']) ? $_GET['chat-id'] : (isset($_POST['chat-id']) ? $_POST['chat-id'] : '');

if (!empty($chatId)) {
    $filename = $directory . $chatId . '.txt';

    if (!file_exists($filename)) {
        file_put_contents($filename, '');
        
        $logMessage = "Created a new chat room: $chatId";
        logActivity($logMessage, $chatId);
    }

    if (isset($_POST['message']) && isset($_POST['user'])) {
        $message = trim($_POST['message']);
        $user = $_POST['user'];

        if (strlen($message) >= 1) {
            file_put_contents($filename, $user . ": " . $message . "\n", FILE_APPEND);
            
            $logMessage = "User '$user' added a message to chat room '$chatId'";
            logActivity($logMessage, $chatId);

            header("Location: index.php?display=true&user=$user&sign-in=true&chat-id=$chatId");
            exit();
        } else {
            header("Location: index.php?error=empty_message&user=$user&display=true&sign-in=true&chat-id=$chatId");
            exit();
        }
    }

} else {
    echo "Chat ID is not provided";
}
?>