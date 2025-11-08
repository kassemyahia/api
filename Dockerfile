# استخدام PHP 8.2 مع FPM
FROM php:8.3-fpm

# تثبيت الأدوات اللازمة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# إنشاء مجلد العمل ونسخ الملفات
WORKDIR /var/www/html
COPY . .

# تثبيت الاعتماديات
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# إعطاء صلاحيات للـ Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 8000

# تشغيل Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
