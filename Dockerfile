# Используем официальный образ PHP-FPM
FROM php:8.1-fpm

# Устанавливаем необходимые расширения PHP и системные пакеты
RUN apt-get update && apt-get install -y \
    libzip-dev \
    git \
    unzip \
    libxml2-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-install xml

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем ВЕСЬ код проекта
COPY --chown=www-data:www-data . .

# Смена пользователя на www-data для установки зависимостей
USER www-data

# Установка зависимостей
RUN composer install --no-dev --optimize-autoloader

# Запускаем PHP-FPM от пользователя www-data
CMD ["php-fpm"]