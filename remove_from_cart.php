<?php
// remove_from_cart.php
session_start();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if (isset($_SESSION['cart']) && array_key_exists($product_id, $_SESSION['cart'])) {
        // Remove the item from the cart
        unset($_SESSION['cart'][$product_id]);
    }
}

header('Location: view_cart.php'); // Redirect back to the cart page
