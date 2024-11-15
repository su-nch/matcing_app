<?php
// matching.php
require 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT user_id, gender, bio FROM profiles WHERE user_id != ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>候補者一覧</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "ユーザーID: " . $row['user_id'] . "<br>";
    echo "性別: " . $row['gender'] . "<br>";
    echo "自己紹介: " . htmlspecialchars($row['bio']) . "<br>";
    echo "<a href='match.php?user2_id=" . $row['user_id'] . "'>マッチング</a>";
    echo "</div><hr>";
}
?>

<?php
// match.php
require 'config.php';
session_start();

$user1_id = $_SESSION['user_id'];
$user2_id = $_GET['user2_id'];

$stmt = $conn->prepare("INSERT INTO matches (user1_id, user2_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user1_id, $user2_id);

if ($stmt->execute()) {
    echo "マッチング成功";
    header("Location: matches.php");
} else {
    echo "エラー: " . $stmt->error;
}
?>
