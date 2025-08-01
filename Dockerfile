# Используем официальный образ PHP-FPM
FROM php:8.3-fpm

# Устанавливаем необходимые расширения PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-install zip

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем Composer-файлы и устанавливаем зависимости
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Копируем остальной код проекта
COPY . .

# Настраиваем права доступа
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public

# Запускаем PHP-FPM
CMD ["php-fpm"]