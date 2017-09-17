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

class Widget implements ModelInterface
{
    use Model;

    /**
     * @var int
     */
    protected $widgetId;

    /**
     * @var int
     */
    protected $widgetGroupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $sortOrder;

    /**
     * @var bool
     */
    protected $showTitle;

    /**
     * @var string
     */
    protected $params;

    /**
     * @var string
     */
    protected $html;

    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @return int
     */
    public function getWidgetId()
    {
        return $this->widgetId;
    }

    /**
     * @param int $widgetId
     * @return Widget
     */
    public function setWidgetId($widgetId)
    {
        $this->widgetId = $widgetId;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidgetGroupId()
    {
        return $this->widgetGroupId;
    }

    /**
     * @param int $widgetGroupId
     * @return Widget
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
     * @return Widget
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     * @return Widget
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowTitle()
    {
        return $this->showTitle;
    }

    /**
     * @param bool $showTitle
     * @return Widget
     */
    public function setShowTitle($showTitle)
    {
        $this->showTitle = $showTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param string $params
     * @return Widget
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param string $html
     * @return Widget
     */
    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Widget
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }
}
