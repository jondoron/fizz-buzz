## Fizz Buzz

Classic FizzBuzz program, with some configurability. Implemented using php 7.4 (typed properties!)
___
### Pre-requisites:
1. Install Docker for your platform: https://docs.docker.com/get-docker/ and ensure the Docker daemon is running.
2. Install PHP dependencies:
```
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install
```
___
### Usage
To run the application with default options. (The range arguments `1 100` are always required)
```
docker run -it --rm -v "$PWD":/app -w /app php:7.4 php console.php fizz-buzz 1 100
```
Default options settings:
* --fizz-number=3
* --fizz-string=Research
* --buzz-number=5
* --buzz-string=Square
___
To run with some of the configurable options:
```
docker run -it --rm -v "$PWD":/app -w /app php:7.4 php console.php fizz-buzz 16 43 --fizz-number=4 --fizz-string=hello --buzz-number=6 --buzz-string=there
```
___
For usage instruction and viewing all configurable options:
```
docker run -it --rm -v "$PWD":/app -w /app php:7.4 php console.php help fizz-buzz
```
___
### Unit Tests
To run the unit tests:
```
docker run -it --rm -v "$PWD":/app -w /app php:7.4 vendor/bin/phpunit tests
```