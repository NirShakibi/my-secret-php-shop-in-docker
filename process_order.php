<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process the order
    $shipping_address = $_POST['shipping_address'];
    $payment_method = $_POST['payment_method'];

    // Process the order, update the database, send confirmation emails, etc.

    // Clear the cart after successful order processing
    unset($_SESSION['cart']);

    // Redirect to a thank-you page or order confirmation page
    header('Location: order_confirmation.php');
} else {
    // Handle invalid requests or direct access to this page
    header('Location: checkout.php');
}
