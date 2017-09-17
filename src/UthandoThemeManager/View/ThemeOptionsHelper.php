<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoThemeManager\View
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoThemeManager\View;

use UthandoCommon\View\AbstractViewHelper;
use UthandoThemeManager\Options\ThemeOptions;
use Zend\Config\Config;

/**
 * Class ThemeOptionsHelper
 *
 * @package UthandoThemeManager\View
 */
class ThemeOptionsHelper extends AbstractViewHelper
{
    /**
     * @var ThemeOptions
     */
    protected $themeOptions;

    public function __invoke($key)
    {
        $this->getOptions();

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
        $returnValue = null;

        if (isset($this->getOptions()->$key)) {
            $returnValue = $this->getOptions()->$key;
        }

        return $returnValue;
    }

    /**
     * @param ThemeOptions $options
     * @return $this
     */
    public function setOptions(ThemeOptions $options)
    {
        $this->themeOptions = $options;
        return $this;
    }

    /**
     * @return ThemeOptions
     */
    public function getOptions()
    {
        if (!$this->themeOptions instanceof ThemeOptions) {
            $options = $this->getServiceLocator()
                ->getServiceLocator()
                ->get(ThemeOptions::class);
            $this->setOptions($options);
        }

        return $this->themeOptions;
    }
} 