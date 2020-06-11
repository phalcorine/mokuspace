<?php


namespace BMS\Plugins;

use Phalcon\Events\Event;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Dispatcher;

/**
 * Class ResponsePlugin
 *
 * This plugin serves as an event handler
 * to a particular event: afterExecuteRoute
 * which is fired immediately a response is
 * available to be sent to the client.
 *
 * @package BMS\Plugins
 */
class ResponsePlugin extends PluginBase
{
    /**
     * Packages the response returned by the controller
     * action after its execution. Only successful
     * responses end up here...
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return ResponseInterface
     */
    public function afterExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $this->response->setJsonContent([
            'code'      => SecurityPlugin::CODE_SUCCESS,
            'status'    => 'success',
            'payload'   => $dispatcher->getReturnedValue()
        ]);


        return $this->response->send();
    }
}