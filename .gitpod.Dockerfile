FROM gitpod/workspace-full

# install development packages
RUN sudo apt update && \
    sudo apt install -y \
    sudo apache2 && \
    sudo rm -rf /var/lib/apt/lists/*

CMD ["/bin/bash"]