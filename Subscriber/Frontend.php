<?php
namespace OssCustomModel\Subscriber;

use Enlight\Event\SubscriberInterface;

class Frontend implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch'
        ];
    }

    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var $controller \Enlight_Controller_Action */
        /** @var $view \Enlight_View_Default */
        /** @var $args \Enlight_Controller_ActionEventArgs */
        /** @var $req  \Enlight_Controller_Request_RequestHttp */
        $controller = $args->getSubject();
        $view = $controller->View();
        $response = $controller->Response();
        $request = $args->getRequest();

        if (!$request->isDispatched()
            || $response->isException()
            || !in_array($request->getModuleName(), ['frontend'])
            || !$view->hasTemplate()
            || !in_array($request->getActionName(), ['index'])
            || !in_array($request->getControllerName(), ['custom'])
            || !Shopware()->Config()->getByNamespace('OssCustomModel', 'active')
        ) {
            return false;
        }

        $view->addTemplateDir(
            dirname(__DIR__) . '/Resources/views/'
        );
        $view->assign('ossPosition',$view->sCustomPage['attribute']['position']);
        $view->assign(
            'ossBanner',
            !empty($view->sCustomPage['attribute'])? $view->sCustomPage['attribute']['custombanner']: null
        );
    }
}
