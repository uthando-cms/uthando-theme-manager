<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 27/12/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Model;


trait WidgetParamsTrait
{
    /**
     * @var string
     */
    protected $params;

    /**
     * @return array|bool
     */
    public function parseParams()
    {
        $params = parse_ini_string((string) $this->getParams(), true);
        return $params;
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
     * @return WidgetModel
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }
}
