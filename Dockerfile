FROM ubuntu:16.04
LABEL maintainer="cslev <cslev@gmx.com>"
# packages needed for compilation
ENV DEV_DEPS automake \
         build-essential \
         clang \
         curl \
         g++-6 \
         git \
         libjudy-dev \
         libgmp-dev \
         libpcap-dev \
         libboost-dev \
         libboost-program-options-dev \
         libboost-system-dev \
         libboost-filesystem-dev \
         libboost-thread-dev \
         libtool \
         pkg-config \
	 libssl-dev
# packages needed for compilation and run
ENV RUN_DEPS sudo \
	 libboost-program-options1.58.0 \
	 libboost-system1.58.0 \
         libboost-filesystem1.58.0 \
         libboost-thread1.58.0 \
         libgmp10 libjudydebian1 \
         libpcap0.8 \
	 net-tools \
	 python \
	 scapy \
 	 tcpdump

#expose thrift port
EXPOSE 9090/tcp

COPY behavioral-model /behavioral-model
# update bashrc to make it fancier
COPY bashrc_root.bmv2 /root/.bashrc
WORKDIR /behavioral-model
# we reinstall $RUN_DEPS in case of apt-get autoremove --purge removed them
RUN apt-get update && \
    apt-get install -y --no-install-recommends $DEV_DEPS $RUN_DEPS && \
    ./install_deps.sh && \
    ./autogen.sh && \
    ./configure && make -j2 && make install && ldconfig && \
    apt-get purge -y $DEV_DEPS && \
    apt-get autoremove --purge -y && \
    apt-get install -y --no-install-recommends $RUN_DEPS && \
    cd .. && \
    rm -rf /behavioral-model /var/cache/apt/* /var/lib/apt/lists/ && \
    echo 'p4-bmv2 image ready'

