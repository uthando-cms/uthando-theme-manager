<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 18/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Form;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use UthandoThemeManager\Form\Element\WidgetGroupSelect;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Number;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class WidgetForm extends Form
{
    public function init()
    {
        $this->add([
            'type'  => Checkbox::class,
            'name'  => 'enabled',
            'options'   => [
                'label' => 'Enabled',
                'use_hidden_element'    => true,
                'checked_value' => 1,
                'unchecked_value'   => 0,
                'column-size'   => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'type'  => Text::class,
            'name'  => 'title',
            'options'   => [
                'label' => 'Title',
                'twb-layout'    => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'   => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'type'  => Checkbox::class,
            'name'  => 'showTitle',
            'options'   => [
                'label' => 'Show Title',
                'use_hidden_element'    => true,
                'checked_value' => 1,
                'unchecked_value'   => 0,
                'column-size'   => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'type'  => Text::class,
            'name'  => 'name',
            'options'   => [
                'label' => 'Name',
                'twb-layout'    => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'   => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'type'  => Text::class,
            'name'  => 'widget',
            'options'   => [
                'label' => 'Widget',
                'twb-layout'    => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'   => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'      => 'widgetGroupId',
            'type'      => WidgetGroupSelect::class,
            'options'   => [
                'label'             => 'Widget Group',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'type'  => Number::class,
            'name'  => 'sortOrder',
            'options'   => [
                'label' => 'Sort Order',
                'twb-layout'    => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'   => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'type'  => Textarea::class,
            'name'  => 'params',
            'options'   => [
                'label' => 'Params',
                'twb-layout'    => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'   => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
            'attributes'    => [
                'rows'  => 5,
            ]
        ]);

        $this->add([
            'type'  => Textarea::class,
            'name'  => 'html',
            'options'   => [
                'label' => 'HTML',
                'twb-layout'    => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'   => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
            'attributes'    => [
                'rows'  => 10,
                'class'       => 'editable-textarea',
                'id'          => 'widget-content-textarea',
            ],
        ]);

        $this->add([
            'type'  => Hidden::class,
            'name'  => 'widgetId',
        ]);
    }
}
