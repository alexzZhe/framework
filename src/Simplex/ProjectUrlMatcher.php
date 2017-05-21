<?php
/**
 * Created by PhpStorm.
 * User: 34953
 * Date: 2017/5/9
 * Time: 23:52
 */
namespace Simplex;

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing;

/**
 * ProjectUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class ProjectUrlMatcher extends Routing\Matcher\UrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // is_leap_year
        if (0 === strpos($pathinfo, '/is_leap_year') && preg_match('#^/is_leap_year(?:/(?P<year>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'is_leap_year')), array (  'year' => NULL,  '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',));
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}