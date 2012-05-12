<!-- scribble-title: Scrubble Readme -->
<!-- scribble-lede: The underlying engine  -->
<!-- scribble-tags: routing dependency-injection event-dispatching templating -->
<!-- scribble-created: 20120508 -->
<!-- scribble-modified: 20120508 -->
<!-- scribble-publish: 1 -->

Powering noteblog apps implementing the [Scribble](https://github.com/sirprize/scribble) text file browsing and converter service.

## Features

+ Controllers for scribble lists, scribble detail, tag browsing, atom feed, JSON API and errors
+ Add functionality by adding services to the [DI container](https://github.com/fabpot/Pimple)
+ Register custom event listeners to hook into every aspect of the [application lifecycle](https://github.com/symfony/EventDispatcher)
+ [Templating](https://github.com/symfony/Templating) with inheritance and partials
+ Perfect urls and [Request routing](https://github.com/symfony/Routing)

## Getting Started

Get [Scribbled](https://github.com/sirprize/scribbled) for a full implementation of Scrubble.

## Routing

The following routes are available by default:

+ `/`
+ `/scribble/{slug}/`
+ `/scribble/{slug}/demo/`
+ `/tag/{tag1}/{tag2}/{tag3}/...`
+ `/feed/scribbles/`
+ `/api/scribbles/`

## Configuration

Scrubble expects the following configuration

    $config = array(
        'php' => array(
            'displayErrors' => <val>,
            'displayStartupErrors' => <val>,
            'errorReporting' => <val>
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
            // config for Sirprize\Scribble\ScribbleDirWithSubdirs
            // see https://github.com/sirprize/scribble
        ),
        'scribble.repository' => array(
            'mode' => <val>,
            'itemsPerPage' => <val>
        ),
        'requires => array(
            dirname(__DIR__).'/vendor/autoload.php',
            dirname(__DIR__).'/vendor-unmanaged/michelf/php-markdown/markdown.php',
            dirname(__DIR__).'/vendor-unmanaged/netcarver/textile/classTextile.php'
        )
    );

## Bootstrapping

    use Sirprize\Scrubble\Bootstrap;

    require_once 'path/to/scrubble/lib/Sirprize/Scrubble/Bootstrap.php';
    $services = Bootstrap::getServices(Bootstrap::run('path/to/config.php'));
    $response = $services->get('kernel')->handle($services->get('request'))->send();

## Templates

Scrubble will look for the following templates by default:

+ `{template-dir}/frontend/scribble/index.phtml`
+ `{template-dir}/frontend/scribble/detail.phtml`
+ `{template-dir}/frontend/tag/index.phtml`
+ `{template-dir}/error.phtml`

## Adding Routes

Grab the default route collection from the service container and add a route to it. The template name is passed to the controller by means of the `template` key. Scrubble will look for this template in `Bootstrap::getServices('env')->getTemplateDir()`. It's up to you whether you want to pass in this value from the routing configuration or do it in some other way from within your controller.

    use Sirprize\Scrubble\Bootstrap;

    $services = Bootstrap::getServices($config);
    $routes = $services->get('routes');

    $routes->add('about', new Route(
        '/about/',
        array('action' => 'MyScribbleApp\Controller\Frontend\AboutAction::indexAction', 'template' => 'about.phtml')
    ));

Removing any of the default routes is just as easy:

    use Sirprize\Scrubble\Bootstrap;

    $services = Bootstrap::getServices($config);
    $routes = $services->get('routes');
    $routes->remove('apiScribbleIndex');

## Adding Controllers

Here's an example of a new controller for your app. It must implement `Sirprize\Scrubble\Controller\ControllerInterface` but by extending `Sirprize\Scrubble\Controller\AbstractController`, this implementation is already taken care of. We're merely left with the job of writing one single action method. It is the responsibility of this method to create, populate and return a response object. Note the `$template` variable in the method signature: it holds the template name from our route config. Remove this variable if your route does not pass in a template name. Also note how the service container is piped through to the template. This allows to request services directly from within templates which is convenient if no preliminary work by the controller is required (eg a config object etc)

    namespace MyScribbleApp\Controller\Frontend;

    use Sirprize\Scrubble\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class AboutController extends AbstractController
    {
        public function indexAction(Request $request, $template)
        {
            $vars = array(
                'services' => $this->getServices()
            );

            return new Response($this->getServices()->get('view')->render($template, $vars));
        }
    }

## Adding Services

Grab the default service container to add, replace or modify services

    use Sirprize\Scrubble\Bootstrap;
    use MyScribbleApp\Service\MyService;

    $services = Bootstrap::getServices($config);
    $services['my.service'] = $services->share(function($c) {
        return new MyService($c['params']['my.service']);
    });

That's it, the new service is available throughout the framework.

## Requirements

+ PHP 5.3+

## Dependencies

+ [Pimple](https://github.com/fabpot/Pimple)
+ [Symfony EventDispatcher](https://github.com/symfony/EventDispatcher)
+ [Symfony HttpFoundation](https://github.com/symfony/HttpFoundation)
+ [Symfony HttpKernel](https://github.com/symfony/HttpKernel)
+ [Symfony Routing](https://github.com/symfony/Routing)
+ [Symfony Templating](https://github.com/symfony/Templating)
+ [Scribble](https://github.com/sirprize/scribble)
+ [Paginate](https://github.com/sirprize/paginate)

## License

See LICENSE.
