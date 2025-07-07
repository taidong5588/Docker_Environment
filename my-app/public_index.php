<?php
// タイムゾーンを環境変数から取得して設定
date_default_timezone_set(getenv('TZ') ?: 'Asia/Tokyo');

// システム情報を表示
echo "<h1>PHP is working!</h1>";
echo "<p>Current time: " . date('Y-m-d H:i:s') . "</p>";

// PHP バージョンの表示
echo "<p>PHP Version: " . phpversion() . "</p>";

// PHP 環境設定の詳細情報を表示（コメントアウト可）
// phpinfo(); // デバッグ時のみ使用（不要な場合は無効のままでOK）
