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

.
├── docker-config/               # コンテナ関連の設定をまとめるディレクトリ
│   ├── db/                      # MariaDB コンテナ用設定
│   │   ├── Dockerfile           # MariaDB イメージをカスタマイズ（オプション）
│   │   └── my.conf              # MariaDB のカスタム設定
│   ├── docker-compose.yml       # サービス全体の構成管理ファイル
│   ├── .env                     # Docker環境変数の設定ファイル
│   ├── .gitignore
│   ├── errors
│   │   └── php_errors.log
│   ├── nginx/                   # Nginx 設定
│   │   ├── default.conf         # 仮想ホストやリバースプロキシなどの定義
│   │   └── Dockerfile           # Nginx コンテナのカスタマイズ（オプション）
│   └── php/                     # PHP-FPM 設定
│       ├── Dockerfile           # PHP-FPM のビルド定義（必要モジュールの追加など）
│       └── php.ini              # PHP 設定ファイル
├── my-app/                      # PHP アプリケーションのソース（Laravel など）
│   └── index.php         
└── README.md                    # セットアップ手順や注意事項の記載

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




