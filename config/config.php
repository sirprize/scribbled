<?php

// config (production)
$production = array(
    'php' => array(
        'displayErrors' => 0,
        'displayStartupErrors' => 0,
        'errorReporting' => E_ALL & ~E_NOTICE,
    ),
    'env' => array(
        'debug' => 0,
        'baseDir' => dirname(__DIR__),
        'libDir' => dirname(__DIR__).'/lib',
        'templateDir' => dirname(__DIR__).'/templates',
        'vendorIncludeDir' => dirname(__DIR__).'/vendor',
        'basePath' => dirname($_SERVER["SCRIPT_NAME"]),
        'mediaPath' => dirname($_SERVER["SCRIPT_NAME"]).'/media',
        'vendorMediaPath' => dirname($_SERVER["SCRIPT_NAME"]).'/media/vendor'
    ),
    'scribble.directory' => array(
        'dir' => dirname(__DIR__).'/scribble',
        'path' => dirname($_SERVER["SCRIPT_NAME"]).'/scribble',
        'files' => array(
            'scribble.md' => array(
                'inputFilters' => array(
                    'Sirprize\Scribble\File\Format\Markdown\InputFilter\CodeSnippetFilter' => array()
                ),
                'outputFilters' => array(
                    'Sirprize\Scribble\File\Format\Markdown\OutputFilter\HtmlConverterFilter' => array(),
                    'Sirprize\Scribble\File\Format\Markdown\OutputFilter\CodeblockLanguageHintFilter' => array()
                )
            ),
            'scribble.textile' => array(
                'inputFilters' => array(
                    'Sirprize\Scribble\File\Format\Textile\InputFilter\CodeSnippetFilter' => array()
                ),
                'outputFilters' => array(
                    'Sirprize\Scribble\File\Format\Textile\OutputFilter\HtmlConverterFilter' => array(),
                    'Sirprize\Scribble\File\Format\Textile\OutputFilter\CodeblockBlankLineFixerFilter' => array(),
                    'Sirprize\Scribble\File\Format\Textile\OutputFilter\CodeblockLanguageHintFilter' => array()
                )
            ),
            'scribble.txt' => array(
                'inputFilters' => array(
                    'Sirprize\Scribble\File\InputFilter\SnippetFilter' => array()
                ),
                'outputFilters' => array(
                    'Sirprize\Scribble\File\Format\Plaintext\OutputFilter\HtmlConverterFilter' => array()
                )
            ),
            'scribble.html' => array(
                'inputFilters' => array(
                    'Sirprize\Scribble\File\InputFilter\SnippetFilter' => array()
                )
            )
        )
    ),
    'scribble.repository' => array(
        'mode' => 'published', // show published scribbles only
        'itemsPerPage' => 20
    ),
    'requires' => array(
        dirname(__DIR__).'/vendor/autoload.php',
        dirname(__DIR__).'/vendor-unmanaged/michelf/php-markdown/markdown.php',
        dirname(__DIR__).'/vendor-unmanaged/netcarver/textile/classTextile.php'
    ),
    'namespaces' => array(),
    'defaults' => array(
        'dateFormat' => 'F d, Y',
        'scribbleImage' => '',
        'siteTitle' => "Scribbled - Notes For Nuts",
        'siteDescription' => "",
        'siteFeedUrl' => '',
        'enableSocialPlugins' => true
    ),
    'google' => array(
        'analyticsId' => '',
    ),
    'facebook' => array(
        'appId' => '',
        'admins' => '',
    )
);

// config (devlopment)
$development = array(
    'php' => array(
        'displayErrors' => 1,
        'displayStartupErrors' => 1,
        'errorReporting' => -1, // show every possible error
    ),
    'env' => array(
        'debug' => 1
    ),
    'scribble.repository' => array(
        'mode' => 'all', // show published and unpublished scribbles
        'itemsPerPage' => 20
    ),
    'defaults' => array(
        'enableSocialPlugins' => false
    )
);

// detect environment and prepare config
$config
    = (preg_match('/(loc|localhost)(:\d+)?$/', $_SERVER['HTTP_HOST']))
    ? array_replace_recursive($production, $development)
    : $production
;
