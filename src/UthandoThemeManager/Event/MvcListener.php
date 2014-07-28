<?php
namespace UthandoThemeManager\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Permissions\Acl\Role\RoleInterface;

class MvcListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = [];
    
    protected $adminTheme = false;

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
        $sm = $event->getApplication()->getServiceManager();
        
        $appConfig = $sm->get('config');
        $themeConfig = $appConfig['theme_manager'];
        $theme = ($this->adminTheme) ? $themeConfig['admin_theme'] : $themeConfig['default_theme'];
        $path = $themeConfig['theme_path'];
        
        $config = null;
        $configFile = $path . $theme . '/config.php';
        
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
        $match = $event->getRouteMatch();
        $controller = $event->getTarget();
        
        if (!$match instanceof RouteMatch) {
            return;
        }
        
        if (0 === strpos($match->getMatchedRouteName(), 'admin')) {
            $this->adminTheme = true;
        }
        
        $this->renderTheme($event);
    }
    
    public function onDispatchError(MvcEvent $event)
    {
    	$request       = $event->getRequest();
    	$requestUri    = $request->getRequestUri(); 
        $auth          = (isset($_SESSION['Zend_Auth'])) ? $_SESSION['Zend_Auth'] : null;
        
        if ($auth && $auth->storage instanceof RoleInterface) {
            $role = $auth->storage->getRoleId();
        } else {
            $role = 'guest';
        }
    
        if (0 === strpos($requestUri, '/admin') && 'admin' === $role) {
		  $this->adminTheme = true;
        }
    	
    	$this->renderTheme($event);
    }
}
