FROM gitpod/workspace-base:latest

# install development packages
RUN sudo apt update && \
    sudo apt install -y \
    php && \
    sudo rm -rf /var/lib/apt/lists/*

CMD ["/bin/bash"]
