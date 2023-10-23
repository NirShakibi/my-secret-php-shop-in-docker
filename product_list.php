<?php
session_start();

$connect = mysqli_connect("localhost", "root", "", "testing");

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($connect, $_POST["name"]);
    $seller = mysqli_real_escape_string($connect, $_POST["seller"]);
    $description = mysqli_real_escape_string($connect, $_POST["description"]);
    $price = mysqli_real_escape_string($connect, $_POST["price"]);

    $query = "INSERT INTO products (name, seller, description, price) VALUES ('$name', '$seller', '$description', '$price')";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        exit();
    } else {
        echo "couldnt add the product! please try again.";
    }
}


// Display products
/*foreach ($products as $product) {
    echo "<div>{$product['name']} - \${$product['price']} <a href='add_to_cart.php?id={$product['id']}'>Add to Cart</a></div>";
}*/

$sql = "SELECT * FROM products";

$result2 = $connect->query($sql);

if ($result2->num_rows > 0) {
    // Fetch and display the data
    while ($row = $result2->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " seller: " . $row["seller"] . " description: " . $row['description'] . " price: $" . $row['price'] . " <a href='add_to_cart.php?id={$row['id']}'>Add to Cart</a> " . "<br>";
        // You can access other columns in a similar way
    }
} else {
    echo "No products found in the database.";
}

$connect->close();

?>
<style>
    body {
        font: 1em sans-serif;
        text-align: center;
        font-size: large;
        font-weight: bold;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
</style>
<nav>
    <a href="./view_cart.php">cart</a>
</nav>
<h1>add a product to the market</h1>
<form action="product_list.php" method="post">
    <input type="text" name="name" placeholder="your product name..." />
    <input type="text" name="seller" placeholder="seller name..." />
    <input type="text" name="description" placeholder="description about the product..." />
    <input type="number" name="price" placeholder="price of the product..." />
    <input type="submit" name="submit" value="submit" />
</form>