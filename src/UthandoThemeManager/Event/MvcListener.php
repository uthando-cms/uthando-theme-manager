<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoThemeManager\Event
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoThemeManager\Event;

use UthandoThemeManager\Options\ThemeOptions;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Role\RoleInterface;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\Http\RouteMatch as HttpRouteMatch;
use Zend\Http\Request;

/**
 * Class MvcListener
 *
 * @package UthandoThemeManager\Event
 */
class MvcListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, [$this, 'onDispatch']);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onDispatchError']);
    }

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

    public function renderTheme(MvcEvent $event)
    {
        $sm             = $event->getApplication()->getServiceManager();
        /** @var ThemeOptions $themeOptions */
        $themeOptions   = $sm->get(ThemeOptions::class);
        $isAdmin        = $this->isAdmin($event);
        $theme          = ($isAdmin) ? $themeOptions->getAdminTheme() : $themeOptions->getDefaultTheme();
        $path           = $themeOptions->getThemePath();
        $config         = null;
        $configFile     = join(DIRECTORY_SEPARATOR, [$path, $theme, 'config.php']);

        if (file_exists($configFile)) {
            $config = include($configFile);
        }

        if (isset($config['template_map'])) {
            $viewResolverMap = $sm->get('ViewTemplateMapResolver');
            $viewResolverMap->add($config['template_map']);
        }

        return true;
    }

    public function isAdmin(MvcEvent $event)
    {
        $routeMatch = $event->getRouteMatch();

        if (!$routeMatch instanceof RouteMatch) {

            $event->setRouteMatch(new HttpRouteMatch([]));
            $request = $event->getRequest();
            $requestUri = $request->getRequestUri();

            $auth = (isset($_SESSION['Zend_Auth'])) ? $_SESSION['Zend_Auth'] : null;
            if ($auth && $auth->storage instanceof RoleInterface) {
                $role = $auth->storage->getRoleId();
            } else {
                $role = 'guest';
            }

            $basePathHelper = $event->getApplication()
                ->getServiceManager()
                ->get('ViewHelperManager')
                ->get('basePath');
            $basePath = $basePathHelper();

            if (0 === strpos($requestUri, $basePath . '/admin') && 'admin' === $role) {
                $event->getRouteMatch()->setParam('is-admin', true);
            }
        }

        return $event->getRouteMatch()->getParam('is-admin') ?: false;
    }

    public function onDispatchError(MvcEvent $event)
    {
        if (!$event->getRequest() instanceof Request) {
            return;
        }

        $this->renderTheme($event);
    }
}
