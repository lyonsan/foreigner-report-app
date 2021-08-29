# phpイメージを引っ張ってくる
FROM php:8.0-fpm-buster
# 各種コマンドのシェル形式で使われるデフォルトのシェルの設定を上書きする
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

# コンテナ内のサーバ環境変数の設定
ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
# １インストール可能なパッケージの一覧を更新し、2laravelのインストールに必要なパッケージをインストールする。
# 3そしてパッケージインストールで使用したキャッシュファイルを削除し、4PHPの拡張ライブラリをインストールする
RUN apt-get update && \
  apt-get -y install git unzip libzip-dev libicu-dev libonig-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

RUN curl https://deb.nodesource.com/setup_12.x | bash
RUN curl https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list


# なんかコピーしている。phpの設定ファイルを複製している
COPY ./php.ini /usr/local/etc/php/php.ini

# これから動かす処理のディレクトリを/workにする
WORKDIR /work