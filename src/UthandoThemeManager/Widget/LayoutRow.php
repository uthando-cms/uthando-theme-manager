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

class LayoutRow extends AbstractViewHelper
{
    use WidgetGroupServiceTrait;

    public function __invoke(WidgetModel $widgetModel): string
    {
        $widgetGroup    = $this->getWidgetGroupService()->getWidgetGroupByName($widgetModel->getName());
        $view           = $this->getView();
        $params         = $widgetModel->parseParams();
        $class          = $params['class'] ?? '';
        $html           = ($class) ? '<div class="' . $view->escapeHtml($class) . '">' : '';

        /** @var WidgetModel $widgetModel */
        foreach ($widgetGroup->getWidgets() as $widgetModel) {
            $widgetClass = $view->escapeHtml($widgetModel->getWidget());

            if ($this->getServiceLocator()->has($widgetClass)) {
                $html .= $view->{$widgetClass}($widgetModel);
            }
        }

        $html .= ($class) ? '</div>' : '';

        return $html;
    }
}
