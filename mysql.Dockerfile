# Use an official MySQL image as the base image
FROM mysql:8.0

# Set the root password (change it to a strong password)
ENV MYSQL_ROOT_PASSWORD=password

# Copy the MySQL initialization script to the container
COPY init.sql /docker-entrypoint-initdb.d/

# Expose port 3306 for MySQL
EXPOSE 3306
