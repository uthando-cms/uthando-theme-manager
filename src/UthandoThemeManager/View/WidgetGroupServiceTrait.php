<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 26/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\View;

use UthandoThemeManager\Service\WidgetGroupManager;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Trait GroupServiceTrait
 * @package UthandoThemeManager\Service
 * @method AbstractPluginManager getServiceLocator()
 */
trait WidgetGroupServiceTrait
{
    /**
     * @var WidgetGroupManager
     */
    protected $widgetGroupManager;

    protected function getWidgetGroupService(): WidgetGroupManager
    {
        if (!$this->widgetGroupManager instanceof WidgetGroupManager) {
            $widgetGroupManager = $this->getServiceLocator()
                ->getServiceLocator()
                ->get('UthandoServiceManager')
                ->get(WidgetGroupManager::class);
            $this->widgetGroupManager = $widgetGroupManager;
        }

        return $this->widgetGroupManager;
    }
}
