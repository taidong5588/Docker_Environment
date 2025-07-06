# PHP 開発用 Docker 環境構築ガイド

このリポジトリは、LaravelなどのPHPアプリに限らず、汎用的なPHP開発を想定した Docker ベースの開発環境を提供します。

---

## 🧩 サービス構成

| サービス     | 内容                           | ポート          |
|--------------|--------------------------------|------------------|
| PHP (8.2)    | PHP-FPM によるアプリ実行       | -                |
| Nginx        | Webサーバ (静的 + PHP対応)     | `http://localhost` |
| MariaDB      | データベース                    | `3306`           |
| phpMyAdmin   | DB GUI ツール                   | `http://localhost:8080` |

---

## 📂 ディレクトリ構成

.
├── docker-compose.yml  # ← プロジェクトルートに配置
├── .env                # ← プロジェクトルートに配置
├── my-app/
│   └── index.php
└── docker-config/
    ├── db/
    │   ├── Dockerfile
    │   └── my.conf
    ├── errors/
    │   └── php_errors.log
    ├── nginx/
    │   ├── Dockerfile
    │   └── default.conf
    └── php/
        ├── Dockerfile
        └── php.ini

---

## 🚀 起動方法（Mac）

```bash
cd docker-config
docker-compose up -d
http://localhost：Nginx経由でアプリにアクセス
http://localhost:8080：phpMyAdminでDB確認
初期 DB接続情報：
ホスト：db
ユーザー：root
パスワード：password
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

この構成で、Laravel、CodeIgniter、Slim、独自PHPフレームワークなどにも柔軟に対応可能な、再利用性の高い開発環境が整います。

次に `.env` テンプレートや、`Makefile` による起動補助なども [追加できます](f)。必要であればお知らせください。


ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
使い方 (How to Use)
.envファイルの作成: プロジェクトルートに.envファイルを作成し、上記の内容を貼り付け、必要に応じて値を変更します。

ファイルの配置: 上記の構成通りに、すべてのディレクトリとファイルを作成・配置します。

コンテナの起動: プロジェクトのルートディレクトリ（docker-compose.ymlがある場所）でターミナルを開き、以下のコマンドを実行します。

Bash

# コンテナを（再）ビルドしてバックグラウンドで起動
docker-compose up -d --build
動作確認: ブラウザで以下のアドレスにアクセスします。（ポート番号は.envファイルの値です）

PHPアプリケーション: http://localhost:8088

phpMyAdmin: http://localhost:8089

コンテナの停止: 環境を停止する際は、以下のコマンドを実行します。

Bash

# コンテナを停止
docker-compose down
データはdb-dataボリュームに残るので、再度docker-compose up -dで起動すればデータは復元されます。