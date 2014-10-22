<?php
namespace UthandoThemeManager\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Http\Request;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplateMapResolver;

class MvcListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch']);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onDispatchError']);
    }

    /**
     * @param MvcEvent $event
     * @return bool
     */
    public function renderTheme(MvcEvent $event)
    {
        $sm             = $event->getApplication()->getServiceManager();
        $isAdmin        = $event->getRouteMatch()->getParam('is-admin');
        $appConfig      = $sm->get('config');
        $themeConfig    = $appConfig['theme_manager'];
        $theme          = ($isAdmin) ? $themeConfig['admin_theme'] : $themeConfig['default_theme'];
        $path           = $themeConfig['theme_path'];
        $config         = null;
        $configFile     = $path . $theme . '/config.php';
        
        if (file_exists($configFile)){
            $config = include ($configFile);
        }

        //$viewResolver = $sm->get('ViewResolver');
        //$themeResolver = new AggregateResolver();
        
        if (isset($config['template_map'])){
            $viewResolverMap = $sm->get('ViewTemplateMapResolver');

            $viewResolverMap->add($config['template_map']);
            /*$mapResolver = new TemplateMapResolver(
                $config['template_map']
            );*/

            //$themeResolver->attach($mapResolver);
        }
        
        //$viewResolver->attach($themeResolver, 10000);

        return true;
    }

    /**
     * @param MvcEvent $event
     */
    public function onDispatch(MvcEvent $event)
    {
        if (!$event->getRequest() instanceof Request) {
        	return;
        }
        
        $match = $event->getRouteMatch();
        
        if (!$match instanceof RouteMatch) {
            return;
        }
        
        $this->renderTheme($event);
    }

    /**
     * @param MvcEvent $event
     */
    public function onDispatchError(MvcEvent $event)
    {
        if (!$event->getRequest() instanceof Request) {
        	return;
        }
    	
    	$this->renderTheme($event);
    }
}
