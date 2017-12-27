<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 24/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\View;

use UthandoCommon\View\AbstractViewHelper;
use UthandoThemeManager\Model\WidgetModel;
use UthandoThemeManager\Service\WidgetGroupManager;
use UthandoThemeManager\Service\WidgetManager;

class WidgetHelper extends AbstractViewHelper
{
    /**
     * @var WidgetGroupManager
     */
    protected $widgetGroupManager;

    /**
     * @var WidgetManager
     */
    protected $widgetManager;

    public function __invoke(string $name): string
    {
        $widgetOrGroup = strstr($name, '-', true);
        $widgetName = substr(strstr($name, '-'), 1);

        if ('group' === $widgetOrGroup) {
            $html = $this->getWidgetGroup($widgetName);
        } else {
            $html = $this->getWidget($name);
        }

        return $html;
    }

    public function getWidgetGroup(string $group): string
    {
        $widgetGroup = $this->getWidgetGroupService()->getWidgetGroupByName($group);

        if (!$widgetGroup) return '';

        $params         = $widgetGroup->parseParams();
        $class          = $params['class'] ?? '';
        $html           = ($class) ? '<div class="' . $this->getView()->escapeHtml($class) . '">' : '';

        /** @var WidgetModel $widgetModel */
        foreach ($widgetGroup->getWidgets() as $widgetModel) {
            $html .= $this->renderWidget($widgetModel);
        }

        $html .= ($class) ? '</div>' : '';

        return $html;
    }

    public function getWidget(string $widget): string
    {
        $widget = $this->getWidgetService()->getWidgetByName($widget);

        if (!$widget) return '';

        return $this->renderWidget($widget);
    }

    public function renderWidget(WidgetModel $widgetModel): string
    {
        $view           = $this->getView();
        $widgetClass    = $view->escapeHtml($widgetModel->getWidget());
        $html           = '';

        if ($this->getServiceLocator()->has($widgetClass)) {
            $html = $view->{$widgetClass}($widgetModel);
        }

        return $html;
    }

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

    protected function getWidgetService(): WidgetManager
    {
        if (!$this->widgetManager instanceof WidgetManager) {
            $widgetManager = $this->getServiceLocator()
                ->getServiceLocator()
                ->get('UthandoServiceManager')
                ->get(WidgetManager::class);
            $this->widgetManager = $widgetManager;
        }

        return $this->widgetManager;
    }
}
