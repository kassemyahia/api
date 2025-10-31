# استخدم صورة PHP مع Apache
FROM php:8.2-apache

# إعدادات PHP و Apache
RUN apt-get update && apt-get install -y libzip-dev unzip git \
    && docker-php-ext-install pdo pdo_mysql zip

# نسخ إعدادات Apache
COPY ./docker/apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# تفعيل mod_rewrite (ضروري للـ routes في Laravel)
RUN a2enmod rewrite

# نسخ المشروع إلى داخل الحاوية
COPY . /var/www/html

# إعداد صلاحيات الملفات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تثبيت Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# تثبيت الحزم (composer install)
WORKDIR /var/www/html
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# فتح المنفذ 80
EXPOSE 80

CMD ["apache2-foreground"]
