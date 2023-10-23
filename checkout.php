<?php
session_start();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $item) {
        // Display product information, quantity, and price
        echo "Product ID: $product_id - Quantity: {$item['quantity']} - Price: $price<br>";
    }
} else {
    echo "Your cart is empty.";
}

// Add input fields for shipping and payment information
echo "<form action='process_order.php' method='post'>";
echo "Shipping Address: <input type='text' name='shipping_address'><br>";
echo "Payment Method: <input type='text' name='payment_method' autocomplete='btc'><br>";
echo "<input type='submit' value='Place Order'>";
echo "</form>";
