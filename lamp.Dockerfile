FROM ubuntu:focal

# install standard development packages
RUN apt update && DEBIAN_FRONTEND=noninteractive apt install -y \
    sudo \
    build-essential \
    cmake \
    git \
    wget \
    && rm -rf /var/lib/apt/lists/*

# setup user: lamp
# configure sudo permission to run without password
# details: https://dev.to/emmanuelnk/using-sudo-without-password-prompt-as-non-root-docker-user-52bg
RUN adduser -home /home/lamp --disabled-password \
    --gecos '' lamp && adduser lamp sudo && \
    echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers
WORKDIR /home/lamp
USER lamp

CMD ["/bin/bash"]