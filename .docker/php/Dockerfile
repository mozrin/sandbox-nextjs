# FROM php:8.3.3-fpm-alpine3.19
FROM php:8.3-fpm

RUN apt-get update
RUN apt-get install -y gnupg2

# Install ODBC, SQLSRV, and PDO_SQLSRV extensions
RUN curl -fsSL https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor -o /usr/share/keyrings/microsoft-prod.gpg
RUN curl https://packages.microsoft.com/config/debian/12/prod.list | tee /etc/apt/sources.list.d/mssql-release.list

RUN apt-get update
RUN ACCEPT_EULA=Y apt-get install -y msodbcsql18 unixodbc-dev

RUN pecl install sqlsrv
RUN pecl install pdo_sqlsrv

RUN echo -e "; priority=20\nextension=sqlsrv.so" | tee /usr/local/etc/php/conf.d/sqlsrv.ini
RUN echo -e "; priority=30\nextension=pdo_sqlsrv.so" | tee /usr/local/etc/php/conf.d/pdo_sqlsrv.ini

RUN apt-get update && apt-get install -y libmariadb-dev-compat \
    && docker-php-ext-install -j$(nproc) pdo_mysql mysqli

RUN pecl install xdebug-3.3.2 \
    && docker-php-ext-enable xdebug

# # Create a new user group
# RUN addgroup --gid 1002 appgroup

# # Create a new user and add it to the group
# RUN adduser --disabled-password --gecos '' --gid 1002 --uid 1002 appuser

# # Set the new user as the default user
# USER appuser