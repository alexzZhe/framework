<?php
ini_set('display_errors', 1);
error_reporting(-1);
date_default_timezone_set('PRC');

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;


$request = Request::createFromGlobals();
$requestStack = new RequestStack();
$routes = include __DIR__.'/../src/app.php';


$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);


$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher, $requestStack));
$listener = new HttpKernel\EventListener\ExceptionListener(
    'Calendar\Controller\ErrorController::exceptionAction'
);
$dispatcher->addSubscriber($listener);
$dispatcher->addSubscriber(new Simplex\StringResponseListener());

#$framework = new Simplex\Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$framework = new Simplex\Framework($dispatcher, $controllerResolver, $requestStack, $argumentResolver);


$response = $framework->handle($request);
$response->send();
