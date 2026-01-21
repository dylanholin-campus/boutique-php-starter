<?php

require 'Database.php';

$pdo = Database::getInstance();

$sql = 'SELECT * FROM users';
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();

echo '<pre>';
print_r($users);
echo '</pre>';
