<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
</head>

<body>
    <h1>Order Confirmation</h1>

    <?php
    // You can add more details about the order here
    // For example, order summary, order number, shipping details, etc.

    // Retrieve the order information from the session or database
    session_start();

    // If you have an order number, you can display it like this
    if (isset($_SESSION['order_number'])) {
        echo "<p>Order Number: " . $_SESSION['order_number'] . "</p>";
    }

    echo "<p>Thank you for your order!</p>";
    ?>

    <p>Your order has been successfully placed.</p>

    <p>For any questions or concerns, please contact our customer support.</p>

    <!-- You can add links or buttons to navigate back to the homepage, for example -->
    <p><a href="index.php">Back to Homepage</a></p>
</body>

</html>