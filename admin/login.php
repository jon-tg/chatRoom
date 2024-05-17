<?php 

echo '<link href="../styles.css" rel="stylesheet" type="text/css">';

$directory = '../data/';
$files = scandir($directory);


$message_files=[];

for ($i=0; $i<count($files); $i++)
{
    if (pathinfo($files[$i], PATHINFO_EXTENSION) == 'txt')
    {
        if (pathinfo($files[$i], PATHINFO_FILENAME) != '')
        {
            array_push($message_files, pathinfo($files[$i], PATHINFO_FILENAME));
        }
    }
}


echo "<h1 id='admin-header'> Message Databases </h1>";
echo "<p id='admin-second-header'> Click on an option below to erase or view chatroom history </p>";


for ($i=0; $i<count($message_files); $i++)
{
    echo "<p id='chatrooms'> $message_files[$i] - "."<a href='delete_history.php?file_name=$message_files[$i]'>Delete</a>"."<a href='get_info.php?file_name=$message_files[$i]'>  -     File Information</a>"."<br/></p>";
}

if (isset($_GET['error']) && $_GET['error']='no-logs')
{
    echo "No logs for the file";
}

if (isset($_GET['deleted']) && $_GET['deleted']=='true')
{
    echo "Successfully deleted chat history";
    echo "<br>";

}


?>