# NolimitsExchange\development-stack

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)

Development environment powered by Docker.

Machine Setup
-----

### MacOS

Requirements:

- [Homebrew](http://brew.sh/)

**1. Install Docker dependencies**

```bash
brew tap codekitchen/dinghy
brew install dinghy docker docker-machine docker-machine-driver-xhyve
```

**2. Create a virtual machine to run our containers on.**

```bash
dinghy create --provider xhyve
```

Running the website
-----

Download the website in the projects directory:

``` bash
git clone https://github.com/nolimits-exchange/website projects/website
```

If you need Xdebug support (we recommend you do)

``` bash
source ./scripts/bootstrap-xdebug.sh
```

Then boot up the application

``` bash
docker-compose up -d
```

and visit http://nolimits.docker

Custom Images
-----

* **web**: https://github.com/nolimits-exchange/docker-web
