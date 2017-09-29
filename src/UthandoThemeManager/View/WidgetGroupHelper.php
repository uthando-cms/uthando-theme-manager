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

class WidgetGroupHelper extends AbstractViewHelper
{
    use WidgetGroupServiceTrait;

    public function __invoke(string $group): string
    {
        $widgetGroup = $this->getWidgetGroupService()->getWidgetGroupByName($group);

        if (!$widgetGroup) return '';

        $view = $this->getView();
        $html = '<div class="row">';

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
