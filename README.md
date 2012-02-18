WebmilTextLanguageDetectBundle
==========================

Bundle to use [text-language-detect](https://github.com/webmil/text-language-detect) with [Symfony2](https://github.com/symfony/symfony).

Installation
------------

Add text-language-detect and WebmilTextLanguageDetectBundle to your vendors:

    git submodule add https://github.com/webmil/text-language-detect.git vendor/text-language-detect
    git submodule add https://github.com/webmil/WebmilTextLanguageDetectBundle.git vendor/bundles/Webmil/TextLanguageDetectBundle

Or add the followings lines to your `deps` file

    // deps
    [WebmilTextLanguageDetectBundle]
        git=git://github.com/webmil/WebmilTextLanguageDetectBundle.git
        target=bundles/Webmil/TextLanguageDetectBundle

    [text-language-detect]
        git=git://github.com/webmil/text-language-detect.git

and run:
    
    $ ./bin/vendors install

Add both to your autoload:

``` php
// app/autoload.php
<?php
$loader->registerNamespaces(array(
    // ...
    'Webmil'               => __DIR__.'/../vendor/bundles',
    'TextLanguageDetect'   => __DIR__.'/../vendor/text-language-detect/lib',
    // ...
));
```

Add the WebmilTextLanguageDetectBundle to your application kernel:

``` php
// app/AppKernel.php
<?php
public function registerBundles()
{
    return array(
        // ...
        new Webmil\TextLanguageDetectBundle\WebmilTextLanguageDetectBundle(),
        // ...
    );
}
```

Configuration example
---------------------
Add in your config.yml file:

``` yaml
webmil_text_language_detect:
    omit_languages:       # Omits languages. If you're only expecting a limited set of languages, this can greatly
        omit_list: ['russian', 'english', 'ukrainian']  # language name or array of names to omit
        include_only: true                              # if true will include (rather than exclude) only those in the list
```

Usage
-----
In controller:

``` php
<?php
// ...
$ld = $this->container->get('text.language.detect'); //or just $this->get('language.detect')
$text = 'Test language detection.';
$lang = $ld->detectConfidence($text);
//...
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
