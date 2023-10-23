<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location:index.php");
}


$mysqli = new mysqli('localhost', 'root', '', 'testing');

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

function sanitize_input($input)
{
    global $mysqli;
    return $mysqli->real_escape_string($input);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $message_content = sanitize_input($_POST['message_content']);
    $sender_username = $_SESSION['username'];
    $receiver_id = sanitize_input($_POST['receiver_id']);

    // Fetch the sender's ID based on the username
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $sender_username);

    // Execute the statement
    $stmt->execute();
    $stmt->bind_result($sender_id);

    // Fetch the result
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Insert message into the database using prepared statement
    $query = "INSERT INTO messages (sender_id, receiver_id, message_content) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message_content);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

$usernames = array();
$usersid = array();
$sql = 'SELECT * FROM users';
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usernames[] = $row['username'];
        $usersid[] = $row['id'];
    }
}

// Close the database connection
///$mysqli->close();

echo "<a href='index.php'>home</a> ";
echo "<a href='messages.php'>messages</a> ";
echo "<a href='post.php'>post</a>";
echo '<h1>welcome ' . $_SESSION["username"] . '</h1>';
echo '<a href="logout.php">logout</a><br />';
echo "<br /> ";
echo "<form method='post' action=''>
<input type='text' name='receiver_id' placeholder='Type your friends id here'>
<textarea name='message_content' placeholder='Type your message' required></textarea>
<button type='submit'>Send Message</button>
</form>";

if (!empty($usernames)) {
    echo '<ul>registered users:';
    foreach ($usernames as $username) {
        foreach ($usersid as $id) {
            echo '<li>' . htmlspecialchars($id) . '</li>';
            echo '<li>' . htmlspecialchars($username) . '</li>';
        }
    }
    echo '</ul>';
} else {
    echo 'No users found.';
}

$posts = array();
$sql2 = "SELECT * FROM posts";
$result2 = $mysqli->query($sql2);
$postsid = array();
$poststitle = array();
$postscontent = array();

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $postsid[] = $row['post_id'];
        $poststitle[] = $row['title'];
        $postscontent[] = $row['content'];
    }
}

foreach ($postsid as $id) {
    echo "$id";
}

/*if (!empty($postsid)) {
    echo '<ul>posts:';
    foreach ($postsid as $id) {
        echo '<li>' . htmlspecialchars($id) . '</li>';
        //echo '<p><a href="/post.php?id=' . $id . ">posttest1</p>';
        echo "<a href='/post.php?id=$id'>post number $id</a>";
    }
    foreach ($poststitle as $title) {
        echo '<li>' . htmlspecialchars($title) . '</li>';
    }
    foreach ($postscontent as $content) {
        echo '<li>' . htmlspecialchars($content) . '</li>';
    }
    echo '</ul>';
} else {
    echo 'No posts found.';
}*/

/*if (!empty($posts)) {
    while ($posts) {
        echo "id: $postsid";
        echo "title: $poststitle";
        echo "content: $postscontent";
    }
}*/

$mysqli->close();
