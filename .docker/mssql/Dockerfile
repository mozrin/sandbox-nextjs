FROM mcr.microsoft.com/mssql/server:2022-latest

ARG USER_ID
ARG GROUP_ID

#
# The user and group ID values are set in
# the .env file used by docker-compose.yml
#
USER root
# Create a new user group
# RUN addgroup --GROUP_ID ${GROUP_ID:-1001} appgroup

# RUN deluser mssql
# RUN adduser --USER_ID ${USER_ID:-1001} --GROUP_ID ${GROUP_ID:-1001} --gecos '' --disabled-password --home /var/opt/mssql mssql 

# Update USER_ID and GROUP_ID of mssql user and group
RUN groupmod -g ${GROUP_ID:-1010} mssql
RUN usermod -u ${USER_ID:-1010} -g ${GROUP_ID:-1010} mssql

USER mssql
