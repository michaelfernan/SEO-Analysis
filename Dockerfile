# Usar a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instalar extensões necessárias para o projeto
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libpng-dev \
    && docker-php-ext-install zip gd mysqli pdo pdo_mysql \
    && apt-get clean

# Habilitar o módulo rewrite do Apache
RUN a2enmod rewrite

# Configurar o diretório de trabalho no container
WORKDIR /var/www/html

# Copiar o código-fonte do projeto para o container
COPY . /var/www/html

# Definir permissões no diretório do projeto
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Instalar Composer no container
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Configurar variáveis de ambiente para o Composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instalar dependências do projeto usando Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --ansi

# Substituir a configuração padrão do Apache com um arquivo customizado
COPY ./config/apache2.conf /etc/apache2/sites-available/000-default.conf

# Habilitar o site padrão
RUN a2ensite 000-default.conf

# Expor a porta 80 para acesso ao Apache
EXPOSE 80

# Comando para iniciar o Apache no container
CMD ["apache2-foreground"]
