# استخدام PHP 8.3 مع FPM
FROM php:8.3-fpm

# تثبيت الأدوات والمكتبات اللازمة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تحديد مجلد العمل
WORKDIR /var/www/html

# نسخ المشروع بالكامل (بما فيهم قاعدة البيانات)
COPY . .

# تثبيت الاعتماديات
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# إعطاء صلاحيات للـ storage و bootstrap/cache وملف قاعدة البيانات
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod 666 /var/www/html/database/database.sqlite || true

# تشغيل أوامر Laravel الأساسية
RUN php artisan key:generate --force || true \
    && php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan route:clear || true

# فتح المنفذ
EXPOSE 8000

# تشغيل السيرفر
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

