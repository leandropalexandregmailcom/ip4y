FROM nginx:latest

# Instalar Dockerize para esperar pelo PHP-FPM
RUN apt-get update && apt-get install -y wget
RUN wget https://github.com/jwilder/dockerize/releases/download/v0.6.1/dockerize-linux-amd64-v0.6.1.tar.gz -O - | tar -xz -C /usr/local/bin

# Copiar arquivos de configuração
COPY default.conf /etc/nginx/conf.d/default.conf
