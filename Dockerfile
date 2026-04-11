FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite for .htaccess
RUN a2enmod rewrite

# Copy application code
COPY . /var/www/html/

# Set the Apache document root to the public/inspire folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public/inspire
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot ${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/sites-available/000-default.conf
RUN sed -i "/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/" /etc/apache2/apache2.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80