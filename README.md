# P4 BMV2 docker container
After a lot of hussle, I was finally able to run BMV2 (P4 behavioral-switch) in a container. For reproducibility and in order to drastically decrease the container's size, I have created the corresponding Dockerfile

# Get the source
```
$ git clone --recursive https://github.com/cslev/p4-bmv2-docker/
$ cd p4-bmv2-docker
```
# Usage
Note the dot (`.`) at the end of the commands!

## pure bmv2 container 
```
$ sudo docker build -t <image_name> .
```
Or alternatively, pull image from [Docker hub](https://hub.docker.com/r/cslev/p4-bmv2/) (compressed images size 409 MB).

## bmv2 + P4runtime capability only
This image has been built accordint to the instructions of [https://github.com/p4lang/behavioral-model/tree/master/targets/simple_switch_grpc](https://github.com/p4lang/behavioral-model/tree/master/targets/simple_switch_grpc).
This container contains the P4runtime capable `simple_switch_grpc` and **all P4Runtime related libraries but nothing more**. 
For a full-fledged combination check the next section.
```
$ sudo docker build -t <image_name> -f Dockerfile.p4runtime_pure .
```

Or alternatively, pull image from [Docker hub](https://hub.docker.com/r/cslev/p4-bmv2-p4runtime/).
During pull, pay attention to the tags, and use tag `pure` (compressed image size: 2GB).

## p4c - development environment 
This image has all ingredients for compiling p4 codes with P4Runtime support for software switch and psa architecture.
Bear in mind that compilation of a P4 code with P4Runtime support can be done as follows:
`p4c-bm2-ss <path to p4 file> --p4runtime-file <path to p4runtime file output> --p4runtime-format text -o <path to JSON output>

```
sudo docker build -t <image_name> -f Dockerfile.p4c .
```
Or alternatively, pull image from [Docker hub](https://hub.docker.com/r/cslev/p4c/) (compressed image size: 1.8GB).


## bmv2 + FULL P4runtime capability [DEPRECATED]
This image might contain too much packages (e.g., `nanomsg`, `thrift`, `simple_switch`, `simple_switch_grpc`). 
Check `Dockerfile.p4runtime` to see whether you need all of these stuffs
```
$ sudo docker build -t <image_name> -f Dockerfile.p4runtime .
```
Or alternatively, pull image from [Docker hub](https://hub.docker.com/r/cslev/p4-bmv2-p4runtime/).
During pull, pay attention to the tags, and use tag `full` (compressed image size: 2GB).

# Notes
All Dockerfiles exposes **only** one respective port, e.g., pure bmv2 exposes 9090, and bmv2-p4runtime images exposes 50051, respectively.
In order to add more control ports to your container just define them via `docker run --expose=PORTNUM` argument.
Then, your image is ready to use.



## You want to add veth to your container?
Go to [this github repository](https://github.com/cslev/add_veth_to_docker) 

