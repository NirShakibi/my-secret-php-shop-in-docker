<?php
session_start();

if (!isset($_SESSION["username"]) && (!isset($_SESSION['id']))) {
    header("location:index.php");
}

// Assuming you have a secure database connection
$mysqli = new mysqli('localhost', 'root', '', 'testing');

// Check the connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Function to sanitize input (prevent SQL injection)
function sanitize_input($input)
{
    global $mysqli;
    return $mysqli->real_escape_string($input);
}

// Fetch the logged-in user's messages
$logged_in_user_id = $_SESSION['id'];
echo "Logged-in user ID: " . $logged_in_user_id;

// Fetch sent messages
$query_sent = "SELECT * FROM messages WHERE sender_id = ?";
$stmt_sent = $mysqli->prepare($query_sent);
$stmt_sent->bind_param("i", $logged_in_user_id);
$stmt_sent->execute();
$result_sent = $stmt_sent->get_result();
if (!$result_sent) {
    die('Error fetching sent messages: ' . $mysqli->error);
    echo "error!";
}
$messages_sent = $result_sent->fetch_all(MYSQLI_ASSOC);

// Fetch received messages
$query_received = "SELECT * FROM messages WHERE receiver_id = ?";
$stmt_received = $mysqli->prepare($query_received);
$stmt_received->bind_param("i", $logged_in_user_id);
$stmt_received->execute();
$result_received = $stmt_received->get_result();
if (!$result_received) {
    die('Error fetching received messages: ' . $mysqli->error);
    echo "error!";
}
$messages_received = $result_received->fetch_all(MYSQLI_ASSOC);

// Close the statements
$stmt_sent->close();
$stmt_received->close();

// Close the database connection
$mysqli->close();
?>

<!-- HTML to display sent messages -->
<h2>Sent Messages</h2>
<ul>
    <?php foreach ($messages_sent as $message) : ?>
        <li><?= $message['message_content']; ?></li>
    <?php endforeach; ?>
</ul>

<!-- HTML to display received messages -->
<h2>Received Messages</h2>
<ul>
    <?php foreach ($messages_received as $message) : ?>
        <li><?= $message['message_content']; ?></li>
    <?php endforeach; ?>
</ul>
<?php echo $_SESSION['id']; ?>