# NolimitsExchange\development-stack

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)

A [nolimits coaster](http://www.nolimitscoaster.com/) community website.

![](http://i.imgur.com/hIf88dW.png)

Development environment powered by Docker.

Machine Setup
-----

### MacOS

Requirements:

- [Homebrew](http://brew.sh/)

1. Install Docker dependencies

    ```bash
    brew tap codekitchen/dinghy
    brew install dinghy docker docker-machine docker-machine-driver-xhyve
    ```

2. Create a virtual machine to run our containers on.

    ```bash
    dinghy create --provider xhyve
    ```

Running the website
-----

1. Enable xdebug support

    ``` bash
    source ./scripts/bootstrap-xdebug.sh
    ```

2. Bring up the development stack

    ``` bash
    docker-compose up -d
    ```
3. Load Fixtures

    ``` bash
    ./bin/fixtures
    ```

4. Start the worker

    ``` bash
    ./bin/worker
    ```

Visit http://nolimits.docker

Custom Images
-----

* **web**: https://github.com/nolimits-exchange/docker-web
