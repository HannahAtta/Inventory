<?php
// session_start();
include('conn.php');
// $table_name = $_SESSION['table'];
// var_dump($table_name);

$stmt = $conn->prepare("SELECT * FROM user WHERE groupId = 0 ");
$stmt->execute();
$rows = $stmt->fetchAll();
$count = $stmt->rowCount();

return $rows;