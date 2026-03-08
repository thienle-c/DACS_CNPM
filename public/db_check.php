<?php
require_once '../app/core/Database.php';
require_once '../config/config.php';

$db = new Database();

echo "Tables in database:\n";
$db->query("SHOW TABLES");
$tables = $db->resultSet();
print_r($tables);

foreach ($tables as $table) {
    $tableName = array_values((array)$table)[0];
    echo "\nStructure of $tableName:\n";
    $db->query("DESCRIBE $tableName");
    print_r($db->resultSet());
}
