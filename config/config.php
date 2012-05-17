<?php

$basePath = (dirname($_SERVER["SCRIPT_NAME"]) == '/') ? '' : dirname($_SERVER["SCRIPT_NAME"]);

$markdown = array(
    'inputFilters' => array(
        'Sirprize\Scribble\File\Format\Markdown\InputFilter\CodeSnippetFilter' => array()
    ),
    'outputFilters' => array(
        'Sirprize\Scribble\File\Format\Markdown\OutputFilter\HtmlConverterFilter' => array(),
        'Sirprize\Scribble\File\Format\Markdown\OutputFilter\CodeblockLanguageHintFilter' => array()
    )
);

$textile = array(
    'inputFilters' => array(
        'Sirprize\Scribble\File\Format\Textile\InputFilter\CodeSnippetFilter' => array()
    ),
    'outputFilters' => array(
        'Sirprize\Scribble\File\Format\Textile\OutputFilter\HtmlConverterFilter' => array(),
        'Sirprize\Scribble\File\Format\Textile\OutputFilter\CodeblockBlankLineFixerFilter' => array(),
        'Sirprize\Scribble\File\Format\Textile\OutputFilter\CodeblockLanguageHintFilter' => array()
    )
);

$plaintext = array(
    'inputFilters' => array(
        'Sirprize\Scribble\File\InputFilter\SnippetFilter' => array()
    ),
    'outputFilters' => array(
        'Sirprize\Scribble\File\Format\Plaintext\OutputFilter\HtmlConverterFilter' => array()
    )
);

$html = array(
    'inputFilters' => array(
        'Sirprize\Scribble\File\InputFilter\SnippetFilter' => array()
    )
);

// config (production)
$production = array(
    'php' => array(
        'displayErrors' => 0,
        'displayStartupErrors' => 0,
        'errorReporting' => E_ALL & ~E_NOTICE,
    ),
    'theme' => array(
        'debug' => 0,
        'templateDir' => dirname(__DIR__).'/vendor/sirprize/themed/templates',
        'mediaPath' => $basePath.'/vendor/sirprize/themed/media',
        'headerAboutText' => 'Hi!',
        'dateFormat' => 'F d, Y',
        'scribbleImage' => '',
        'siteTitle' => "Scribbled - The Noteblog For Scribblers",
        'siteDescription' => "",
        'siteFeedUrl' => '',
        'enableTwitterAndPlusOne' => true
    ),
    'scribble.directory' => array(
        'dir' => dirname(__DIR__).'/scribble',
        'path' => '/scribble',
        'files' => array(
            'scribble.md' => $markdown,
            'scribble.textile' => $textile,
            'scribble.txt' => $plaintext,
            'scribble.html' => $html
        )
    ),
    'scribble.repository' => array(
        'mode' => 'published', // show published scribbles only
        'itemsPerPage' => 20
    ),
    'page.directory' => array(
        'dir' => dirname(__DIR__).'/page',
        'suffices' => array(
            'md' => $markdown,
            'textile' => $textile,
            'txt' => $plaintext,
            'html' => $html
        )
    ),
    'page.repository' => array(
        'mode' => 'published' // show published scribbles only
    ),
    'requires' => array(
        dirname(__DIR__).'/vendor/autoload.php',
        dirname(__DIR__).'/vendor-uncomposed/michelf/php-markdown/markdown.php',
        dirname(__DIR__).'/vendor-uncomposed/netcarver/textile/classTextile.php'
    ),
    'namespaces' => array(),
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
    'theme' => array(
        'debug' => 1,
        'enableTwitterAndPlusOne' => false
    ),
    'scribble.repository' => array(
        'mode' => 'all', // show published and unpublished scribbles
        'itemsPerPage' => 20
    )
);

// detect environment and prepare config
$config
    = (preg_match('/(localhost)(:\d+)?$/', $_SERVER['HTTP_HOST']))
    ? array_replace_recursive($production, $development)
    : $production
;
