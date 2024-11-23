FROM mcr.microsoft.com/mssql/server:2022-latest

ARG UID
ARG GID

#
# The user and group ID values are set in
# the .env file used by docker-compose.yml
#
USER root
# Create a new user group
# RUN addgroup --gid ${GID:-1001} appgroup

# RUN deluser mssql
# RUN adduser --uid ${UID:-1001} --gid ${GID:-1001} --gecos '' --disabled-password --home /var/opt/mssql mssql 

# Update UID and GID of mssql user and group
RUN groupmod -g ${GID:-1010} mssql
RUN usermod -u ${UID:-1010} -g ${GID:-1010} mssql

USER mssql
