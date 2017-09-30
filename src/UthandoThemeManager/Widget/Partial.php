<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 30/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Widget;

use UthandoCommon\View\AbstractViewHelper;
use UthandoThemeManager\Model\WidgetModel;

class Partial extends AbstractViewHelper
{
    public function __invoke(WidgetModel $widgetModel): string
    {
        $params         = $widgetModel->parseParams();
        $view           = $params['view'] ?? $widgetModel->getName() ?? '';
        $widgetPartial  = 'widget/' . $this->getView()->escapeHtml($view);

        return $this->getView()->partial($widgetPartial, [
            'widget' => $widgetModel,
            'params' => $params,
        ]);
    }
}
