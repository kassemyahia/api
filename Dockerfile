# استخدم صورة PHP مع Apache
FROM php:8.2-apache

# تثبيت المكتبات الأساسية
RUN apt-get update && apt-get install -y libzip-dev unzip git \
    && docker-php-ext-install pdo pdo_mysql zip

# نسخ إعدادات Apache
COPY ./docker/apache/laravel.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# نسخ ملفات composer فقط أولاً
WORKDIR /var/www/html
COPY composer.json composer.lock ./

# تثبيت Composer من صورة رسمية
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# تثبيت حزم Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# نسخ باقي ملفات المشروع
COPY . .

# صلاحيات مجلدات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# فتح المنفذ 80
EXPOSE 80

# تشغيل Apache
CMD ["apache2-foreground"]
