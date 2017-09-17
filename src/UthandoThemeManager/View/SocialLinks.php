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

use UthandoCommon\Stdlib\StringUtils;
use UthandoCommon\View\AbstractViewHelper;
use UthandoThemeManager\Options\ThemeOptions;

/**
 * Class SocialLinks
 *
 * @package UthandoThemeManager\View
 */
class SocialLinks extends AbstractViewHelper
{
    /**
     * @var array
     */
    protected $attributes = [
        'class' => 'social fa fa-%s',
        'title' => '%s',
    ];

    /**
     * @var string
     */
    protected $template = '<a href="%s" %s>%s</a>';

    /**
     * @var string
     */
    protected $iconElement = '';

    /**
     * @param null|array $attributes
     * @return string
     */
    public function __invoke(array $attributes = null)
    {
        if ($attributes) {
            $this->setAttributes($attributes);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $options = $this->getOptions();
        $html   = "";

        if (!empty($options->getSocialLinks())) {
            $links = $options->getSocialLinks();

            foreach ($links as $key => $value) {
                $attributes = '';

                if (!StringUtils::startsWith($value, 'http')) {
                    $value = $this->getView()->url($value);
                }

                foreach($this->getAttributes() as $attr => $val) {
                    $attributes .= $attr . '="' . sprintf($val, $key) . '" ';
                }

                $html .= sprintf($this->getTemplate(), $value, $attributes, sprintf($this->getIconElement(), $key)) . PHP_EOL;
            }
        }

        return $html;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $class
     * @return $this
     */
    public function setAttributes(array $class)
    {
        $this->attributes = array_merge($this->attributes, $class);
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string
     */
    public function getIconElement()
    {
        return $this->iconElement;
    }

    /**
     * @param $iconElement
     * @return $this
     */
    public function setIconElement($iconElement)
    {
        $this->iconElement = $iconElement;
        return $this;
    }

    /**
     * @return ThemeOptions
     */
    public function getOptions()
    {
        if (!$this->options instanceof ThemeOptions) {
            $options = $this->getServiceLocator()
                ->getServiceLocator()
                ->get(ThemeOptions::class);
            $this->options = $options;
        }

        return $this->options;
    }
} 