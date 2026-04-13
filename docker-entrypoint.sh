#!/bin/bash
set -e

if [ -z "${APACHE_DOCUMENT_ROOT:-}" ]; then
  echo "ERROR: APACHE_DOCUMENT_ROOT is not set. Define it in docker-compose.yml." >&2
  exit 1
fi

if [ ! -d "$APACHE_DOCUMENT_ROOT" ]; then
  echo "ERROR: APACHE_DOCUMENT_ROOT directory does not exist: $APACHE_DOCUMENT_ROOT" >&2
  exit 1
fi

if [ ! -f "$APACHE_DOCUMENT_ROOT/index.php" ] && [ ! -f "$APACHE_DOCUMENT_ROOT/index.html" ]; then
  echo "ERROR: No index.php or index.html found in APACHE_DOCUMENT_ROOT: $APACHE_DOCUMENT_ROOT" >&2
  exit 1
fi

escaped_root=$(printf '%s\n' "$APACHE_DOCUMENT_ROOT" | sed 's/[\/&]/\\&/g')

sed -i -E "s|DocumentRoot .*|DocumentRoot ${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/sites-available/000-default.conf
sed -i -E "s|<Directory /var/www(/html)?>|<Directory ${APACHE_DOCUMENT_ROOT}>|g" /etc/apache2/apache2.conf
sed -i "/<Directory ${escaped_root}>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/" /etc/apache2/apache2.conf

exec "$@"
