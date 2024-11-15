<?php
// chat.php
session_start();

// ログインしていない場合、ログインページにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>チャット</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>チャット</h1>
    </header>

    <div id="chat-container">
        <div id="messages"></div>
        <form id="chat-form">
            <input type="text" id="message" placeholder="メッセージを入力..." required>
            <button type="submit">送信</button>
        </form>
        <nav>
            <a href="setting.php">設定に戻る</a>
        </nav>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const messagesDiv = document.getElementById('messages');
            const chatForm = document.getElementById('chat-form');
            const messageInput = document.getElementById('message');

            const addMessageToDiv = (user, message) => {
                const msgDiv = document.createElement('div');
                msgDiv.textContent = user + ': ' + message;
                messagesDiv.appendChild(msgDiv);
            };

            const updateMessages = () => {
                fetch('get_messages.php')
                    .then(response => response.json())
                    .then(data => {
                        messagesDiv.innerHTML = '';
                        data.forEach(msg => {
                            addMessageToDiv(msg.user, msg.message);
                        });
                    });
            };

            chatForm.addEventListener('submit', (event) => {
                event.preventDefault();
                const message = messageInput.value;
                fetch('send_message.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        messageInput.value = '';
                        // メッセージを即座に表示する
                        fetch('get_user.php')
                            .then(response => response.json())
                            .then(userData => {
                                addMessageToDiv(userData.username, message);
                            });
                    }
                });
            });

            setInterval(updateMessages, 3000); // 3秒ごとにメッセージを更新
            updateMessages(); // 初期メッセージの取得
        });
    </script>
</body>
</html>
