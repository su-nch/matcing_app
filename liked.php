<?php
// エラーメッセージ表示を有効にする
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// セッション開始
session_start();

// データベース接続
$mysqli = new mysqli("localhost", "root", "", "matching_app");
if ($mysqli->connect_error) {
    die("接続失敗: " . $mysqli->connect_error);
}

// ログイン中のユーザーのIDを取得
$current_user_id = $_SESSION['user_id'] ?? null;

// ユーザーがログインしているか確認
if (!$current_user_id) {
    die("ログインしてください。");
}

// いいねを送ってきたユーザーの情報を取得するSQLクエリ
$query = "
    SELECT u.id, u.username, u.created_at, l.liked_at, p.nickname, p.photo_path, p.gender
    FROM likes l
    JOIN users u ON l.user_id = u.id
    JOIN profiles p ON u.id = p.user_id
    WHERE l.liked_user_id = ?
    ORDER BY l.liked_at DESC
";

// クエリの準備
$stmt = $mysqli->prepare($query);
if (!$stmt) {
    die("SQLエラー: " . $mysqli->error);
}

// パラメータをバインドしてクエリを実行
$stmt->bind_param("i", $current_user_id);
$stmt->execute();

// 結果の取得
$result = $stmt->get_result();
$liked_by_users = $result->fetch_all(MYSQLI_ASSOC);

// HTMLで結果を表示
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>いいねされた相手</title>
</head>
<body>
    <h1>いいねされた相手の一覧</h1>

    <?php if (!empty($liked_by_users)): ?>
        <ul>
            <?php foreach ($liked_by_users as $user): ?>
                <li>
                    <strong><?php echo htmlspecialchars($user['nickname'] ?: $user['username']); ?></strong>
                    <p>性別: <?php echo htmlspecialchars($user['gender']); ?></p>
                    <p>いいねされた日時: <?php echo htmlspecialchars($user['liked_at']); ?></p>
                    <p>ユーザー登録日時: <?php echo htmlspecialchars($user['created_at']); ?></p>
                    
                    <?php if (!empty($user['photo_path'])): ?>
                        <img src="<?php echo htmlspecialchars($user['photo_path']); ?>" alt="プロフィール写真" width="100">
                    <?php else: ?>
                        <p>写真がありません</p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>まだ誰もあなたにいいねをしていません。</p>
    <?php endif; ?>
</body>
</html>

<?php
// データベース接続のクローズ
if (isset($stmt)) {
    $stmt->close();
}
$mysqli->close();
?>


