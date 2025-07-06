<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docker PHP Environment</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        h1, h2 {
            color: #2c3e50;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }
        .status {
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 15px;
        }
        .status.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        pre {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Docker PHP Environment</h1>
        <p>このページが表示されていれば、NginxとPHP-FPMは正常に動作しています。</p>

        <h2>データベース接続テスト</h2>
        <?php
        // 環境変数からデータベース情報を取得
        $db_host = getenv('DB_HOST');
        $db_name = getenv('DB_DATABASE');
        $db_user = getenv('DB_USERNAME');
        $db_pass = getenv('DB_PASSWORD');

        try {
            // mysqliを使用してデータベースに接続
            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

            echo '<div class="status success">データベースへの接続に成功しました！ (' . $conn->host_info . ')</div>';
            $conn->close();

        } catch (Exception $e) {
            echo '<div class="status error">データベースへの接続に失敗しました。</div>';
            echo '<pre>エラー: ' . htmlspecialchars($e->getMessage()) . '</pre>';
            echo '<p>docker-compose.yml、.envファイル、またはDBサービスのログを確認してください。</p>';
        }
        ?>

        <h2>PHP Information</h2>
        <?php
        // phpinfo()はセキュリティリスクになる可能性があるため、開発環境でのみ使用してください。
        // phpinfo();
        echo "<p>PHP Version: " . phpversion() . "</p>";
        ?>
    </div>
</body>
</html>
