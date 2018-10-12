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


use Zend\Config\Reader\Ini;

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
        $params = new Ini();
        return $params->fromString($this->getParams());
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
