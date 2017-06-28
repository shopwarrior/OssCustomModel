<?php

namespace OssCustomModel\Subscriber;

use Enlight\Event\SubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ControllerPath implements SubscriberInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_OssCustomModel' => 'onGetControllerOssCustomModel',
            'Enlight_Controller_Dispatcher_ControllerPath_Widgets_OssCustomModel' => 'onGetlWidgetsOssCustomModel',
        ];
    }

    /**
     * Widgets controller
     *
     * @param   \Enlight_Event_EventArgs $args
     * @return  string
     * @Enlight\Event Enlight_Controller_Dispatcher_ControllerPath_Widgets_OssCustomModel
     */
    public function onGetTestimonialWidgetsPath(\Enlight_Event_EventArgs $args)
    {
        $this->container->get('template')->addTemplateDir( dirname(__DIR__) . '/Resources/views/' );
        return dirname(__DIR__) . '/Controllers/Widgets/OssCustomModel.php';
    }


    /**
     * Backend controller
     *
     * @param   \Enlight_Event_EventArgs $args
     * @return  string
     * @Enlight\Event Enlight_Controller_Dispatcher_ControllerPath_Backend_OssCustomModel
     */
    public function onGetControllerOssCustomModel(\Enlight_Event_EventArgs $args)
    {
        $this->container->get('template')->addTemplateDir( dirname(__DIR__) . '/Resources/views/' );
        return dirname(__DIR__) . '/Controllers/Backend/OssCustomModel.php';
    }
}
