<?php
// update_cart.php
session_start();

if (isset($_POST['quantity'])) {
    $new_quantities = $_POST['quantity'];

    foreach ($new_quantities as $product_id => $quantity) {
        // Ensure the quantity is greater than 0 and update the cart
        if ($quantity > 0 && isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }
}

header('Location: view_cart.php'); // Redirect back to the cart page
