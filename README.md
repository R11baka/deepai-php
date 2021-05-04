## Simple php client for using deepai.org

Simple php wrapper for using https://deepai.org/machine-learning-model/colorizer
api

## How to use

1. Pass your api-key to Deepai constuctor and ypu can colorize file by path.

```injectablephp
$dp = new \R11baka\Deepai\Deepai("1111111");
$resp = $dp->colorizeFromPath('./lena.jpg');
echo $resp->getUrl(); // returns url with colorized image
echo $resp->getId(); // return id for colorized job
```

2. You have method getUrl ,which have url with colorized image
