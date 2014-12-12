<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 * 
 * @package   UthandoThemeManager\View
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoThemeManager\View;

use UthandoCommon\View\AbstractViewHelper;
use Zend\Config\Config;

/**
 * Class ThemeOptions
 * @package UthandoThemeManager\View
 */
class ThemeOptions extends AbstractViewHelper
{
    protected $themeConfig;

    public function __invoke($key)
    {
        if (!$this->themeConfig instanceof Config) {
            $config = $this->getConfig('theme_manager');

            if (!$config instanceof Config) {
                $config = new Config($config);
            }

            $this->themeConfig = $config;
        }

        if (is_string($key)) {
            return $this->get($key);
        }

        return $this;
    }

    /**
     * @param $key
     * @return Config|string|null
     */
    public function get($key)
    {
        $keys = explode('.', $key);
        $returnValue = null;
        $config = $this->themeConfig;

        foreach ($keys as $key) {

            $returnValue = $config->get($key);

            if ($returnValue instanceof Config) {
                $config = $returnValue;
            }
        }

        return $returnValue;
    }
} 