WebmilLanguageDetectBundle
==========================

Bundle to use [text-language-detect](https://github.com/webmil/text-language-detect) with [Symfony2](https://github.com/symfony/symfony).

Installation
------------

Add text-language-detect and WebmilLanguageDetectBundle to your vendors:

    git submodule add https://github.com/webmil/text-language-detect.git vendor/text-language-detect
    git submodule add https://github.com/webmil/WebmilLanguageDetectBundle.git vendor/bundles/Webmil/LanguageDetectBundle

Add both to your autoload:

    // app/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'Webmil'               => __DIR__.'/../vendor/bundles',
        'TextLanguageDetect'   => __DIR__.'/../vendor/text-language-detect/lib',
        // ...
    ));

Add the WebmilLanguageDetectBundle to your application kernel:

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Webmil\LanguageDetectBundle\WebmilLanguageDetectBundle(),
            // ...
        );
    }

Usage example
-------------
In controller:

```php
$ld = $this->container->get('language.detect'); \\or just $this->get('language.detect')
$text = 'Test language detection.';
$lang = $ld->detectConfidence($text);
```
print_r($lang):

    // output
    Array
    (
        [language] => english
        [similarity] => 0.33985507246377
        [confidence] => 0.018985507246377
    )

Author
------
[Webmil](http://www.webmil.com.ua/)
