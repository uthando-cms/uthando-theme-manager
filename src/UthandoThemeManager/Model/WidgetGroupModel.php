<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 17/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Model;

use UthandoCommon\Model\Model;
use UthandoCommon\Model\ModelInterface;

class WidgetGroupModel implements ModelInterface
{
    use Model,
        WidgetParamsTrait;

    /**
     * @var int
     */
    protected $widgetGroupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $widgets = [];

    /**
     * @return int
     */
    public function getWidgetGroupId()
    {
        return $this->widgetGroupId;
    }

    /**
     * @param int $widgetGroupId
     * @return WidgetGroupModel
     */
    public function setWidgetGroupId($widgetGroupId)
    {
        $this->widgetGroupId = $widgetGroupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return WidgetGroupModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * @param array $widgets
     * @return WidgetGroupModel
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;
        return $this;
    }
}
