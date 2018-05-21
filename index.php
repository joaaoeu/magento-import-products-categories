<?php
$conn = new mysqli('localhost', 'user', 'password', 'database');

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error); }

$db_prefix = 'mage_';
$file = fopen('productsCategories.csv', 'r');

$productsCategories = Array();

if ($file) {
    $truncate = $conn->query("TRUNCATE TABLE ".$db_prefix."catalog_category_product;");

    $delete = $conn->query("DELETE FROM ".$db_prefix."catalog_category_product_index WHERE category_id != 2;");

    while (($line = fgetcsv($file)) !== false) {
      $productsCategories[] = $line; }

    fclose($file);

    $count_line = 0;

    foreach ($productsCategories as $productCategory) {
        $count_line++;
        $sku = $productCategory[0];
        $category_id = $productCategory[1];

        $select = $conn->query("SELECT entity_id FROM ".$db_prefix."catalog_product_entity WHERE sku = '$sku';");

        if ($select->num_rows == 1) {
            while($product = $select->fetch_assoc()) {
                $product_id = $product["entity_id"];

                $insert = $conn->query("INSERT INTO ".$db_prefix."catalog_category_product (category_id, product_id, position) VALUES ($category_id, $product_id, 1);");

                $insert = $conn->query("INSERT INTO ".$db_prefix."catalog_category_product_index (category_id, product_id, position, is_parent, store_id, visibility) VALUES ($category_id, $product_id, 1, 1, 1, 4);");

                echo "<strong>$count_line</strong> SUCCESS<br>";
            }
        } else { echo "<strong>$count_line</strong> SKU INCORRECT<br>"; }
    }

    echo '<h1>Products categories updated!</h1>';
}

$conn->close();
