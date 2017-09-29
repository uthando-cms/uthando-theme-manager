<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 23/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Widget;

use UthandoCommon\View\AbstractViewHelper;
use UthandoThemeManager\Model\WidgetModel;
use UthandoThemeManager\View\WidgetGroupServiceTrait;

class LayoutDefault extends AbstractViewHelper
{
    use WidgetGroupServiceTrait;

    public function __invoke(WidgetModel $widget): string
    {
        $widgetGroup    = $this->getWidgetGroupService()->getWidgetGroupByName($widget->getName());
        $view           = $this->getView();
        $params         = $widget->parseParams();
        $class          = $params['class'] ?? '';
        $html           = '<div class="' . $view->escapeHtml($class) . '">';

        /** @var WidgetModel $widget */
        foreach ($widgetGroup->getWidgets() as $widget) {
            $widgetClass = $view->escapeHtml($widget->getWidget());

            if ($this->getServiceLocator()->has($widgetClass)) {
                $html .= $view->{$widgetClass}($widget);
            }
        }

        $html .= '</div>';

        return $html;
    }
}
