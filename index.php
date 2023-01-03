<?php
// Connect to the database
$db = new mysqli('localhost', 'username', 'password', 'pharmacy');

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data
  $name = $db->real_escape_string($_POST['name']);
  $quantity = (int)$_POST['quantity'];
  $price = (float)$_POST['price'];

  // Insert the new product into the database
  $db->query("INSERT INTO products (name, quantity, price) VALUES ('$name', $quantity, $price)");
}

// Query the database for the list of products
$result = $db->query('SELECT * FROM products');

// Display the products
echo '<table>';
echo '<tr><th>Name</th><th>Quantity</th><th>Price</th></tr>';
while ($row = $result->fetch_assoc()) {
  echo '<tr>';
  echo "<td>{$row['name']}</td>";
  echo "<td>{$row['quantity']}</td>";
  echo "<td>{$row['price']}</td>";
  echo '</tr>';
}
echo '</table>';

// Display the add product form
echo '<form method="POST">';
echo '<label for="name">Name:</label>';
echo '<input type="text" id="name" name="name"><br>';
echo '<label for="quantity">Quantity:</label>';
echo '<input type="number" id="quantity" name="quantity"><br>';
echo '<label for="price">Price:</label>';
echo '<input type="number" id="price" name="price"><br>';
echo '<input type="submit" value="Add Product">';
echo '</form>';
