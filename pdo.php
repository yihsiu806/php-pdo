<?php
// https://phpdelusions.net/pdo

$host = "localhost";
$db = "sql_store";
$user = "root";
$pass = "";
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
    exit();
}

// query
$sql = "select last_name, first_name, (points+10) from customers";
$stmt = $pdo->query($sql);
foreach ($stmt as $row) {
    echo "<div>".$row['first_name']."</div>";
    echo "<div>".$row['last_name']."</div>";
    echo "<div>".$row['points']."</div>";
}

// prepare
$quantity = 90;
$sql = "SELECT COUNT(*) FROM products WHERE quantity_in_stock >= ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$quantity]);
$count = $stmt->fetchColumn();
if ($count != 0) {
    
}

// fetch
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$post_username, $hashed_post_password]);
$stmt->fetch();

?>