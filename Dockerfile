# Use an official PHP runtime as the base image
FROM php:7.4-apache

# Install necessary extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update && apt-get install -y default-mysql-client


# Copy the PHP application code to the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Expose port 80 for Apache
EXPOSE 80
