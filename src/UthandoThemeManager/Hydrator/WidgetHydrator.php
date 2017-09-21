<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 18/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Hydrator;


use UthandoCommon\Hydrator\AbstractHydrator;
use UthandoCommon\Hydrator\Strategy\NullStrategy;
use UthandoCommon\Hydrator\Strategy\TrueFalse;
use UthandoThemeManager\Model\WidgetModel;

class WidgetHydrator extends AbstractHydrator
{
    public function __construct()
    {
        parent::__construct();

        $this->addStrategy('bool', new TrueFalse());
        $this->addStrategy('null', new NullStrategy());
    }

    /**
     * Extract values from an object
     *
     * @param  WidgetModel $object
     * @return array
     */
    public function extract($object)
    {
        return [
            'widgetId'          => $object->getWidgetId(),
            'widgetGroupId'     => $this->extractValue('null', $object->getWidgetGroupId()),
            'title'             => $object->getTitle(),
            'name'              => $object->getName(),
            'widget'            => $object->getWidget(),
            'sortOrder'         => $object->getSortOrder(),
            'showTitle'         => $this->extractValue('bool', $object->isShowTitle()),
            'params'            => $object->getParams(),
            'html'              => $object->getHtml(),
            'enabled'           => $this->extractValue('bool', $object->isEnabled()),
        ];
    }
}
