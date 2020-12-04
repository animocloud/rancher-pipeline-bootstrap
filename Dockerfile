FROM php:7.4

RUN apt-get update && \
	apt-get install -y --no-install-recommends \
		git \
		ssh-client \
		zip \
		libsqlite3-dev \
		zlib1g-dev \
		libzip-dev \
		unzip \
		dnsutils

RUN docker-php-ext-install zip