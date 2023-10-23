<?php
// add_to_cart.php
session_start(); // Start or resume the session

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (array_key_exists($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = ['quantity' => 1];
    }
}

header('Location: view_cart.php'); // Redirect back to the product list page
