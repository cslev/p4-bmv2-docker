# P4 BMV2 docker container
After a lot of hussle, I was finally able to run BMV2 (P4 behavioral-switch) in a container. For reproducibility and in order to drastically decrease the container's size, I have created the corresponding Dockerfile

# Usage
```
$ git clone --recursive https://github.com/cslev/p4-bmv2-docker/
$ cd p4-bmv2-docker
$ sudo docker build -t <image_name> .
```

Then, your image is ready to use.

## You want to add veth to your container?
Go to [this github repository](https://github.com/cslev/add_veth_to_docker) 

