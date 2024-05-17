<?php

$file_name = $_GET['file_name'];
$directory = '../data/';

$file_path = $directory . $file_name.'.txt';

file_put_contents($file_path," ");
header("Location: login.php?deleted=true");
exit();

   
?>