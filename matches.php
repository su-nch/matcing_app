<?php
// matches.php
require 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT user1_id, user2_id, matched_at FROM matches WHERE user1_id = ? OR user2_id = ?");
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>マッチ一覧</h2>";
while ($row = $result->fetch_assoc()) {
    $matched_user_id = ($row['user1_id'] == $user_id) ? $row['user2_id'] : $row['user1_id'];
    
    $profile_stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $profile_stmt->bind_param("i", $matched_user_id);
    $profile_stmt->execute();
    $profile_stmt->bind_result($username);
    $profile_stmt->fetch();

    echo "<div>";
    echo "ユーザー名: " . htmlspecialchars($username) . "<br>";
    echo "マッチング日時: " . $row['matched_at'] . "<br>";
    echo "</div><hr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>マッチ一覧</title>
</head>
<body>
    <a href="search_form.php">検索</a>
    <a href="setting.php">設定に戻る</a>
</body>
</html>