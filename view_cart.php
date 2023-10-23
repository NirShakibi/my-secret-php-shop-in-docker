<?php
// view_cart.php
session_start();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $item) {
        echo "Product ID: $product_id - ";
        // Display the current quantity and provide an input field to update it
        echo "<input type='number' name='quantity[$product_id]' value='{$item['quantity']}' min='1' />";
        echo "<a href='remove_from_cart.php?id=$product_id'>Remove</a><br>";
    }
} else {
    echo "Your cart is empty.";
}

echo "<a href='product_list.php'>market</a>";
echo "<input type='submit' value='Update Cart'>";
echo "</form>";
echo "<a href='checkout.php'>checkout</a>";
