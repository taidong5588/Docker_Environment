# PHP 開発用 Docker 環境構築ガイド

このリポジトリは、LaravelなどのPHPアプリに限らず、汎用的なPHP開発を想定した Docker ベースの開発環境を提供します。

---

## 🧩 サービス構成

| サービス     | 内容                           | ポート          |
|--------------|--------------------------------|------------------|
| PHP (8.2)    | PHP-FPM によるアプリ実行       | -                |
| Nginx        | Webサーバ (静的 + PHP対応)     | `http://localhost:80` |
| MariaDB      | データベース                    | `3306`           |
| phpMyAdmin   | DB GUI ツール                   | `http://localhost:8080` |

---

## 📂 ディレクトリ構成

project-root/
├── .env                       # 環境変数定義ファイル
├── docker-compose.yml        # Docker Compose によるサービス定義
├── docker-config/            # 各サービスの構成フォルダ
│   ├── db/                   # MariaDB 設定関連
│   │   ├── Dockerfile        # MariaDB カスタムビルド（必要な場合）
│   │   └── my.conf           # MariaDB 設定ファイル
│   ├── nginx/                # Nginx 設定関連
│   │   ├── Dockerfile        # Nginx カスタムビルド
│   │   └── default.conf      # 仮想ホスト、リバースプロキシ設定
│   ├── php/                  # PHP-FPM 設定関連
│   │   ├── Dockerfile        # PHP カスタムイメージ
│   │   └── php.ini           # PHP 設定ファイル
│   ├── errors/               # エラーログ出力用フォルダ
│   │   └── php_errors.log    # PHP エラーログファイル（空でOK）
│   └── .gitignore            # Gitに含めないファイルの指定
├── my-app/                   # PHP アプリケーション本体（Laravel等）
│   └── public/
│       └── index.php       　 # テスト用PHPファイル（初期）
└── README.md                 # プロジェクト説明書


---

## 🚀 起動方法（Mac）

```bash
cd docker-config
docker-compose up -d
# コンテナを（再）ビルドしてバックグラウンドで起動の場合
docker-compose up -d --build
PHPアプリケーション: http://localhost:80
phpMyAdmin: http://localhost:8080

コンテナの停止: 環境を停止する際は、以下のコマンドを実行します。
# コンテナを停止
Bash
docker-compose down
データはdb-dataボリュームに残るので、再度　docker-compose up -d　で起動すればデータは復元されます。

初期 DB接続情報：
ホスト：db
ユーザー：root
パスワード：root_password_secret
🛠 開発 Tips

PHP エラー確認：
tail -f ../errors/php_errors.log
Composer 実行：
docker compose exec php composer install
MariaDB 初期設定は docker-compose.yml の environment にて変更可能
📝 補足

Laravel を使う場合は my-app/public/ をドキュメントルートにしてください
本番環境では環境変数やDB設定を .env に分離するのが推奨です
Mac 上では my-app/ 配下を自由に編集して即時反映できます

---




