FROM php:8.4-fpm

# 시스템 패키지 설치
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libgd-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    unzip \
    zip \
    git \
    curl \
    ca-certificates \
    libssl-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libjpeg-dev \
    libpng-dev \
    libicu-dev \
    libxml2-dev \
    --no-install-recommends

# GD 설정 후 설치
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && docker-php-ext-install gd

# 필수 PHP 모듈 설치
RUN docker-php-ext-install \
    curl \
    mbstring \
    pdo \
    pdo_mysql \
    simplexml \
    zip \
    intl \
    opcache \
    exif \
    fileinfo


# APCu 설치 및 활성화
RUN pecl install apcu && docker-php-ext-enable apcu

# 인증서 업데이트 및 정리
RUN update-ca-certificates && apt-get clean && rm -rf /var/lib/apt/lists/*

# php.ini 복사
COPY ./custom-php.ini /usr/local/etc/php/conf.d/

# Composer 설치
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Timezone 설정
ENV TZ=Asia/Seoul

# 작업 디렉토리
WORKDIR /var/www/html

# 포트 및 기본 실행
EXPOSE 9000
CMD ["php-fpm"]