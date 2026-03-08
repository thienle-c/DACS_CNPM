<?php
require_once 'app/bootstrap.php';
$db = new Database();

// Update iPhone
$db->query("UPDATE products SET image = 'iphone_15_pro.png' WHERE name LIKE '%iPhone%' LIMIT 1");
$db->execute();

// Update MacBook
$db->query("UPDATE products SET image = 'macbook_air_m3.png' WHERE name LIKE '%MacBook%' LIMIT 1");
$db->execute();

// Update others to a sample placeholder if not set
$db->query("UPDATE products SET image = 'smartphones_collection.png' WHERE image IS NULL OR image = ''");
$db->execute();

echo "Database image paths updated successfully.";
unlink(__FILE__);
