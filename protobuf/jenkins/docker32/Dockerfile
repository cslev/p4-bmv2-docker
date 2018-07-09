# This Dockerfile specifies the recipe for creating an image for the tests
# to run in.
#
# We install as many test dependencies here as we can, because these setup
# steps can be cached.  They do *not* run every time we run the build.
# The Docker image is only rebuilt when the Dockerfile (ie. this file)
# changes.

# Base Dockerfile for gRPC dev images
FROM 32bit/debian:latest

# Apt source for php
RUN echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu trusty main" | tee /etc/apt/sources.list.d/various-php.list && \
  apt-key adv --keyserver keyserver.ubuntu.com --recv-keys F4FCBB07

# Install dependencies.  We start with the basic ones require to build protoc
# and the C++ build
RUN apt-get clean && apt-get update && apt-get install -y --force-yes \
  autoconf \
  autotools-dev \
  build-essential \
  bzip2 \
  ccache \
  curl \
  gcc \
  git \
  libc6 \
  libc6-dbg \
  libc6-dev \
  libgtest-dev \
  libtool \
  make \
  parallel \
  time \
  wget \
  unzip \
  # -- For python --
  python-setuptools \
  python-pip \
  python-dev \
  # -- For C++ benchmarks --
  cmake  \
  # -- For PHP --
  php5.5     \
  php5.5-dev \
  php5.5-xml \
  php5.6     \
  php5.6-dev \
  php5.6-xml \
  php7.0     \
  php7.0-dev \
  php7.0-xml \
  phpunit    \
  valgrind   \
  libxml2-dev \
  && apt-get clean

##################
# PHP dependencies.
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN mv composer.phar /usr/bin/composer
RUN php -r "unlink('composer-setup.php');"
RUN cd /tmp && \
  git clone https://github.com/google/protobuf.git && \
  cd protobuf/php && \
  git reset 46ae90dc5e145b12fffa7e053a908a9f3e066286 && \
  ln -sfn /usr/bin/php5.5 /usr/bin/php && \
  ln -sfn /usr/bin/php-config5.5 /usr/bin/php-config && \
  ln -sfn /usr/bin/phpize5.5 /usr/bin/phpize && \
  composer install && \
  mv vendor /usr/local/vendor-5.5 && \
  ln -sfn /usr/bin/php5.6 /usr/bin/php && \
  ln -sfn /usr/bin/php-config5.6 /usr/bin/php-config && \
  ln -sfn /usr/bin/phpize5.6 /usr/bin/phpize && \
  composer install && \
  mv vendor /usr/local/vendor-5.6 && \
  ln -sfn /usr/bin/php7.0 /usr/bin/php && \
  ln -sfn /usr/bin/php-config7.0 /usr/bin/php-config && \
  ln -sfn /usr/bin/phpize7.0 /usr/bin/phpize && \
  composer install && \
  mv vendor /usr/local/vendor-7.0
RUN wget http://am1.php.net/get/php-5.5.38.tar.bz2/from/this/mirror
RUN mv mirror php-5.5.38.tar.bz2
RUN tar -xvf php-5.5.38.tar.bz2
RUN cd php-5.5.38 && ./configure --enable-maintainer-zts --prefix=/usr/local/php-5.5-zts && \
    make && make install && make clean && cd ..
RUN cd php-5.5.38 && ./configure --enable-bcmath --prefix=/usr/local/php-5.5-bc && \
    make && make install && make clean && cd ..

##################
# Python dependencies

# These packages exist in apt-get, but their versions are too old, so we have
# to get updates from pip.

RUN pip install pip --upgrade
RUN pip install virtualenv tox yattag

##################
# Prepare ccache

RUN ln -s /usr/bin/ccache /usr/local/bin/gcc
RUN ln -s /usr/bin/ccache /usr/local/bin/g++
RUN ln -s /usr/bin/ccache /usr/local/bin/cc
RUN ln -s /usr/bin/ccache /usr/local/bin/c++
RUN ln -s /usr/bin/ccache /usr/local/bin/clang
RUN ln -s /usr/bin/ccache /usr/local/bin/clang++

# Define the default command.
CMD ["bash"]
