<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 18/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Controller;

use UthandoCommon\Controller\AbstractCrudController;
use UthandoThemeManager\Service\WidgetGroupManager;

class WidgetGroupController extends AbstractCrudController
{
    protected $controllerSearchOverrides = ['sort' => 'widgetGroupId'];
    protected $serviceName = WidgetGroupManager::class;
    protected $route = 'admin/theme-manager/widget-group';
    protected $routes = [];
}
