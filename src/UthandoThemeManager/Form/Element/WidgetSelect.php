<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 23/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Form\Element;

use Zend\Form\Element\Select;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class WidgetSelect
 * @package UthandoThemeManager\Form\Element
 * @method AbstractPluginManager getServiceLocator()
 */
class WidgetSelect  extends Select implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $emptyOption = '---Select Widget---';

    public function getValueOptions(): array
    {
        $options = $this->valueOptions ?: $this->getOptionList();
        return $options;
    }

    public function getOptionList(): array
    {
        $config = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('config');

        $widgets = preg_grep(
            '/\\\\Widget\\\\/',
            $config['view_helpers']['invokables']
        );

        $widgetOptions= [];

        foreach($widgets as $widget) {
            $widgetOptions[] = [
                'label' => $widget,
                'value' => $widget,
            ];
        }

        return $widgetOptions;
    }
}
