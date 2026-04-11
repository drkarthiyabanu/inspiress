FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite for .htaccess
RUN a2enmod rewrite

# Copy application code
COPY . /var/www/html/

# If the app uses a public directory, point Apache there
RUN if [ -d /var/www/html/public ]; then \
    sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf; \
  fi

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80