FROM gitpod/workspace-mysql

USER root
# Downgrade to php v7.4
RUN add-apt-repository ppa:ondrej/php && \
    install-packages php7.4 && \
    update-alternatives --set php /usr/bin/php7.4

USER gitpod
# update composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    HASH="$(wget -q -O - https://composer.github.io/installer.sig)" && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

CMD ["/bin/bash"]
