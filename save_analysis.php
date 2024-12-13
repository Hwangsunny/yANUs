<?php
require 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "error:unauthorized";
    exit;
}

if (!isset($_POST['player_id']) || !isset($_POST['title']) || !isset($_POST['content'])) {
    echo "error:missing_data";
    exit;
}

$playerId = $_POST['player_id'];
$title = $_POST['title'];
$content = $_POST['content'];
$author = $_SESSION['username'] ?? '익명';

$stmt = $conn->prepare("INSERT INTO player_analysis (player_id, title, content, author) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $playerId, $title, $content, $author);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
$conn->close();
exit;
?>