<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17/5/9
 * Time: 19:52
 */
namespace Simplex;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContentLengthListener implements EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }

    public static function getSubscribedEvents()
    {
        return array('response' => array('onResponse', -255));
    }
}