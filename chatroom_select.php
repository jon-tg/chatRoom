<?php

echo '<link href="styles.css" rel="stylesheet" type="text/css">';
echo '<h1>Lets Chat!</h1>';

if (isset($_GET['user']) && (strlen($_GET['user']) < 1)) {
    header("Location: index.php?error=empty_message");
    exit();
}


$directory = 'data/';
$files = scandir($directory);
$files = array_diff($files, array('.', '..'));

$chat_create = '<form id="chat-create" method="GET" action="index.php">
<label for="chat-id">Create New Chatroom: </label>
<input type="hidden" name="user" id="user" value="' . $_GET["user"] . '">
<input type="hidden" name="display" id="display" value="true">
<input type="hidden" name="sign-in" id="sign-in" value="true">
<input type="text" id="chat-id" name="chat-id" placeholder="Enter Chatroom Name">
<button id="create-chatroom">Create</button>
</form>';

$chat_select = '<form id="chat-select" method="GET" action="index.php">
<label for="existing-chatrooms">Select Existing Chatroom: </label>
<select name="chat-id" id="existing-chatrooms">';

foreach ($files as $file) {
    $chatRoomName = pathinfo($file, PATHINFO_FILENAME);
    if ($chatRoomName!='')
    {
        $chat_select .= '<option value="' . $chatRoomName . '">' . $chatRoomName . '</option>';
    }
}

$chat_select .= '</select>
<input type="hidden" name="user" id="user" value="' . $_GET["user"] . '">
<input type="hidden" name="display" id="display" value="true">
<input type="hidden" name="sign-in" id="sign-in" value="true">

<button id="submit-chatroom">Join</button>
</form>';

echo $chat_create;
echo $chat_select;

if ($_GET['error'] == 'empty_message') {
    echo "Please enter a valid input";
}

echo "<a id='admin' href='admin.html'>Admin Page</a>"



?>