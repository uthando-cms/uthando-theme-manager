<?php
namespace UthandoThemeManager;

use Zend\Mvc\MvcEvent;
use UthandoThemeManager\Event\MvcListener;

class Module
{
    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $eventManager->attach(new MvcListener());
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/config.php';
    }
    
    public function getServiceConfig()
    {
    	return [
    	'factories'     => [
        	   'UthandoThemeManager\Options\ThemeOptions'  => 'UthandoThemeManager\Service\ThemeOptionsFactory',
        	],
    	];
    }
    
    public function getViewHelperConfig()
    {
    	return [
    	   'invokables' => [
    	       'Bootstrap'      => 'UthandoThemeManager\View\BootStrapTheme',
               'SocialLinks'    => 'UthandoThemeManager\View\SocialLinks',
    	       'ThemePath'      => 'UthandoThemeManager\View\ThemePath',
    	   ],
    	];
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php'
            ],
        ];
    }
}
