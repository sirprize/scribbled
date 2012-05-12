# Scribbled

Noteblog for scribblers and coders.

![Scribbled](https://github.com/sirprize/themed/raw/master/media/images/scribbled.png)

## Features

+ All-in-one notes and blogging application
+ Your notes in text files under version control
+ Adapters for [Markdown](http://daringfireball.net/projects/markdown/syntax), [Textile](http://textile.thresholdstate.com/), plain text and HTML
+ Ideal for code blogging - embed code snippets from external files in your notes
+ Responsive and fluid layout based on [HTML5 Boilerplate](http://html5boilerplate.com/)
+ Third party integrations: Opengraph, Google Analytics etc

Scribbled is a concrete implementation of [Scrubble](https://github.com/sirprize/scrubble) and merely provides configuration and bootstrapping. Use it as the starting point for your own app and start scribblin'

## Get Scribbled

+ `cd <webroot>`
+ `git clone git://github.com/sirprize/scribbled.git scribbled`
+ `cd scribbled`
+ `php composer.phar install`

Point your browser to `/scribbled`

## Requirements

+ PHP 5.3+

## Dependencies

These fine libraries ship with Scribbled:

+ [Pimple](https://github.com/fabpot/Pimple)
+ [Symfony EventDispatcher](https://github.com/symfony/EventDispatcher)
+ [Symfony HttpFoundation](https://github.com/symfony/HttpFoundation)
+ [Symfony HttpKernel](https://github.com/symfony/HttpKernel)
+ [Symfony Routing](https://github.com/symfony/Routing)
+ [Symfony Templating](https://github.com/symfony/Templating)
+ [Doctrine2 Common](https://github.com/doctrine/common)
+ [Php Markdown](https://github.com/michelf/php-markdown/)
+ [Textile](https://github.com/netcarver/textile)
+ [Scrubble](https://github.com/sirprize/scrubble)
+ [Scribble](https://github.com/sirprize/scribble)
+ [Paginate](https://github.com/sirprize/paginate)
+ [Themed](https://github.com/sirprize/themed)

## License

See LICENSE.