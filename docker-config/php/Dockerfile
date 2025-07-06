# 公式のPHP-FPMイメージをベースとして使用 (バージョン8.2)
FROM php:8.2-fpm

# ワーキングディレクトリを設定
WORKDIR /var/www

# 必要なライブラリとPHP拡張機能をインストール
# - git, curl, zip: 一般的な開発ツール
# - pdo_mysql, mysqli: MariaDB/MySQL接続用
# - zip: Composerなどで必要
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    zip \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mysqli \
    zip

# Composer (PHPパッケージマネージャ) をグローバルにインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# セキュリティ向上のため、専用ユーザー(www)でPHP-FPMを実行
# www-dataではなく、ホストのユーザーID(1000)に合わせることが多い
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/sh -g www www

# ユーザーを切り替え
USER www

# ポート9000を公開し、php-fpmサーバーを起動
EXPOSE 9000
CMD ["php-fpm"]
