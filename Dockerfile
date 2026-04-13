FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite for .htaccess
RUN a2enmod rewrite

# Copy application code
COPY . /var/www/html/

# Copy runtime entrypoint to set Apache DocumentRoot and directory permissions
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-php-entrypoint", "/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]

# Expose port 80
EXPOSE 80