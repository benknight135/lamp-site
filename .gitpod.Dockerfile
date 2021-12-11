FROM gitpod/workspace-full

# install development packages
RUN sudo apt update && \
    sudo apt install -y \
    lamp-server^

CMD ["/bin/bash"]
