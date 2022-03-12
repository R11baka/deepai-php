## Simple php client for using deepai.org

Simple php wrapper for using https://deepai.org/machine-learning-model/colorizer
api
## Installation
```
composer require r11baka/deepai
```
## How to use

1. Pass your api-key to Deepai constuctor and ypu can colorize file by path.

```injectablephp
$dp = new \R11baka\Deepai\Deepai("{YOU API_KEY FETCHED FROM DEEP AI}");
$resp = $dp->colorizeFromPath('./lena.jpg');
echo $resp->getUrl(); // returns url with colorized image
echo $resp->getId(); // return id for colorized job
```
 Also you can colorize with content of file

```injectablephp
$dp = new \R11baka\Deepai\Deepai("{YOU API_KEY FETCHED FROM DEEP AI}");
$resp = $dp->colorize(file_get_contents("./lena.jpg"));
echo $resp->getUrl(); // returns url with colorized image
echo $resp->getId(); // return id for colorized job
```

2. You have method getUrl ,which have url with colorized image

## How to run test
