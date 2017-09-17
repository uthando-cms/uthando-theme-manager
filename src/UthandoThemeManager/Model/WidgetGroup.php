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

class WidgetGroup implements ModelInterface
{
    use Model;

    /**
     * @var int
     */
    protected $widgetGroupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getWidgetGroupId()
    {
        return $this->widgetGroupId;
    }

    /**
     * @param int $widgetGroupId
     * @return WidgetGroup
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
     * @return WidgetGroup
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
