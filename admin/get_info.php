<?php

echo '<link href="../styles.css" rel="stylesheet" type="text/css">';

$fileName = $_GET['file_name'];

    $logFilePath = '../logs/' . $fileName . '.txt';

    if (file_exists($logFilePath)) 
    {

        $logContents = file_get_contents($logFilePath);

        echo "<h1 id='info-header'>System Usage Logs for $fileName</h1>";
        echo "<pre id='data'>$logContents</pre>";
    }
    else
    {
        header("Location: login.php?error='no-logs'");
        exit();
    }



?>