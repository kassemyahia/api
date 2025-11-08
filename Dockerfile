# استخدام PHP 8.3 مع FPM
FROM php:8.3-fpm

# تثبيت الأدوات والمكتبات اللازمة
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

# تحديد مجلد العمل
WORKDIR /var/www/html

# نسخ جميع ملفات المشروع
COPY . .

# تثبيت الاعتماديات
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# إنشاء مجلد قاعدة البيانات في حال لم يكن موجوداً
RUN mkdir -p /var/www/html/database

# إعطاء صلاحيات كاملة لمجلدات Laravel المطلوبة
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 777 /var/www/html/database

# فتح المنفذ 8000
EXPOSE 8000

# تشغيل سيرفر Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
# Run migrations and seed the database
RUN php artisan migrate --force && php artisan db:seed --force
