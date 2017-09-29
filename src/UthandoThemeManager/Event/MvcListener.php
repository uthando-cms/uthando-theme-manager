<?php declare(strict_types=1);
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
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Role\RoleInterface;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\Http\RouteMatch as HttpRouteMatch;

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
            return null;
        }

        $match = $event->getRouteMatch();

        if (!$match instanceof RouteMatch) {
            return null;
        }

        $this->renderTheme($event);
    }

    /**
     * @param MvcEvent $event
     * @return bool
     */
    public function renderTheme(MvcEvent $event): bool
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
            /** @noinspection PhpIncludeInspection */
            $config = include($configFile);
        }

        if (isset($config['template_map'])) {
            $viewResolverMap = $sm->get('ViewTemplateMapResolver');
            $viewResolverMap->add($config['template_map']);
        }

        return true;
    }

    /**
     * @param MvcEvent $event
     * @return bool
     */
    public function isAdmin(MvcEvent $event): bool
    {
        $routeMatch = $event->getRouteMatch();

        if (!$routeMatch instanceof RouteMatch) {

            $event->setRouteMatch(new HttpRouteMatch([]));

            /** @var Request $request */
            $request = $event->getRequest();
            $requestUri = $request->getRequestUri();

            $auth = $_SESSION['Zend_Auth'] ?? null;
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

        return $event->getRouteMatch()->getParam('is-admin') ?? false;
    }

    public function onDispatchError(MvcEvent $event): bool
    {
        if (!$event->getRequest() instanceof Request) {
            return false;
        }

        return $this->renderTheme($event);
    }
}
