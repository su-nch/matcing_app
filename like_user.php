<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$liked_user_id = $_POST['liked_user_id'];
$user_id = $_SESSION['user_id'];
$date1 = "2024-10-24 15:20:00";

// いいねをデータベースに保存
$sql = "INSERT INTO likes (user_id, liked_user_id) VALUES (2, 5)";
$stmt = $conn->prepare($sql);
//$stmt->bind_param("ii", $user_id,$liked_user_id);

if ($stmt->execute()) {
    echo "いいねしました!";
    header("Location: menu.php");
} else {
    echo "エラーが発生しました: " . $stmt->error;
}

$stmt->close();
$conn->close();
