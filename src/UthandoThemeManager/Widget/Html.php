<?php
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

class Html extends AbstractViewHelper
{
    public function __invoke(WidgetModel $widgetModel): string
    {
        $view   = $this->getView();
        $params = $widgetModel->parseParams();
        $class  = $params['class'] ?? '';
        $html   = ($class) ? '<div class="' . $view->escapeHtml($class) . '">' : '';
        $html  .= $widgetModel->getHtml();
        $html  .=  ($class) ? '</div>' : '';

        return $html;
    }
}
