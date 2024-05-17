<?php

echo '<link href="styles.css" rel="stylesheet" type="text/css">';
echo '<h1>Lets Chat!</h1>';

$user = '<form id="username" method="GET" action="chatroom_select.php">
<label for="user"> Username: </label>
<input type="hidden" name="display" id="display" value="true">
<input type="text" name="user">
<button>Get Started</button>
</form>';


$message = '<form id="message" method="POST" action="add_message.php">
<label id="message" for="message"> Message: </label>
<input type="hidden" name="user" id="user" value="' . $_GET["user"] . '">
<input type="hidden" name="chat-id" value='.$_GET['chat-id'].'>
<input type="text" name="message">
<button>Submit</button>
</form>';


if (isset($_GET['chat-id'])) {
    if (strlen($_GET['chat-id']) < 1) {
        header("Location: chatroom_select.php?error=empty_message");
        exit();
    } else {
        $chatId = $_GET['chat-id'];
    }
}

if (isset($_GET['display']) && $_GET['display']=='true')
{
    echo '<textarea id="chat-history" rows="10" cols="50" onscroll="handleScroll(event)"></textarea>';
    echo $message;

}

if (!isset($_GET['sign-in']))
{
    echo $user;
} 

if ($_GET['error'] == 'empty_message') {
    echo "Please enter a valid input";
}

echo "<a id='admin' href='admin.html'>Admin Page</a>"

?>

<script>
    let scrolling = false;
    let lastScrollTop = 0;
    let newMessage=false;

    function handleScroll(event) {
        scrolling = true;
    }

    function getChatMessages() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('display')) {
            fetch('data/<?php echo $chatId ?>.txt')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    newMessage=true;
                    const chatHistory = document.getElementById('chat-history');

                    chatHistory.value = data;

                    if (!scrolling && newMessage) {
                    chatHistory.scrollTop = chatHistory.scrollHeight;
                }

                    scrolling = false;
                    newMessage=false;
                })
                .catch(error => console.error('Error fetching chat messages:', error));
        }
    }

    getChatMessages();

    setInterval(getChatMessages, 1000);

</script>

