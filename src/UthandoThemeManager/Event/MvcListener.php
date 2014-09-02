<?php
namespace UthandoThemeManager\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Permissions\Acl\Role\RoleInterface;
use Zend\Http\Request;

class MvcListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = [];

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch']);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onDispatchError']);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
    
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
        
        $viewResolver = $sm->get('ViewResolver');
        $themeResolver = new \Zend\View\Resolver\AggregateResolver();
        
        if (isset($config['template_map'])){
            $viewResolverMap = $sm->get('ViewTemplateMapResolver');
            $viewResolverMap->add($config['template_map']);
            $mapResolver = new \Zend\View\Resolver\TemplateMapResolver(
                $config['template_map']
            );
            $themeResolver->attach($mapResolver);
        }
        
        $viewResolver->attach($themeResolver, 1000);
        
        return true;
    }
    
    public function onDispatch(MvcEvent $event)
    {
        if (!$event->getRequest() instanceof Request) {
        	return;
        }
        
        $match = $event->getRouteMatch();
        $controller = $event->getTarget();
        
        if (!$match instanceof RouteMatch) {
            return;
        }
        
        $this->renderTheme($event);
    }
    
    public function onDispatchError(MvcEvent $event)
    {
        if (!$event->getRequest() instanceof Request) {
        	return;
        }
    	
    	$this->renderTheme($event);
    }
}
