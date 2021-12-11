FROM gitpod/workspace-full

# install development packages
RUN sudo apt update && \
    sudo apt install -y \
    lamp-server^ \
    wordpress && \
    sudo rm -rf /var/lib/apt/lists/*

CMD ["/bin/bash"]
