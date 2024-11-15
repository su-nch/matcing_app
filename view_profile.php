<?php
// view_profile.php
session_start();

// ログインしていない場合、ログインページにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'config.php';

// ユーザーIDの取得
$user_id = $_SESSION['user_id'];

// プロフィール情報の取得
$sql = "SELECT gender, bio, photo_path, nickname, age, languages, tall, category, blood, figure, beer, MBTI, college, Birthplace, birthdate FROM profiles WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();
$stmt->close();

$conn->close();

// デフォルト値の設定
$default_profile = [
    'gender' => '未設定',
    'bio' => '未設定',
    'photo_path' => '',
    'nickname' => '未設定',
    'age' => '未設定',
    'languages' => '未設定',
    'tall' => '未設定',
    'category' => '未設定',
    'blood' => '未設定',
    'figure' => '未設定',
    'beer' => '未設定',
    'MBTI' => '未設定',
    'college' => '未設定',
    'Birthplace' => '未設定',
    'birthdate' => ''
];

foreach ($default_profile as $key => $value) {
    if (!array_key_exists($key, $profile)) {
        $profile[$key] = $value;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール表示</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>プロフィール</h1>
        <nav>
            <a href="setting.php">設定に戻る</a>
            <a href="edit_profile.php">プロフィールを編集する</a>
        </nav>
    </header>

    <main>
        <h2>プロフィール情報</h2>
        <p>性別: <?php echo htmlspecialchars($profile['gender']); ?></p>
        <p>自己紹介: <?php echo htmlspecialchars($profile['bio']); ?></p>
        <?php if (!empty($profile['photo_path'])): ?>
            <img src="<?php echo htmlspecialchars($profile['photo_path']); ?>" alt="プロフィール写真" width="100">
        <?php endif; ?>
        <p>ニックネーム: <?php echo htmlspecialchars($profile['nickname']); ?></p>
        <p>年齢: <?php echo htmlspecialchars($profile['age']); ?></p>
        <p>言語: <?php echo htmlspecialchars($profile['languages']); ?></p>
        <p>身長: <?php echo htmlspecialchars($profile['tall']); ?></p>
        <p>学年: <?php echo htmlspecialchars($profile['category']); ?></p>
        <p>血液型: <?php echo htmlspecialchars($profile['blood']); ?></p>
        <p>体型: <?php echo htmlspecialchars($profile['figure']); ?></p>
        <p>お酒: <?php echo htmlspecialchars($profile['beer']); ?></p>
        <p>MBTI: <?php echo htmlspecialchars($profile['MBTI']); ?></p>
        <p>カレッジ: <?php echo htmlspecialchars($profile['college']); ?></p>
        <p>出身地: <?php echo htmlspecialchars($profile['Birthplace']); ?></p>
        <p>生年月日: <?php echo htmlspecialchars($profile['birthdate']); ?></p>
    </main>
</body>
</html>

