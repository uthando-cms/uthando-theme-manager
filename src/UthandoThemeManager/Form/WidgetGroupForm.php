<?php declare(strict_types=1);
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
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class WidgetGroupForm extends Form
{
    public function init()
    {
        $this->add([
            'type'      => Text::class,
            'name'      => 'name',
            'options'   => [
                'label'             => 'Name',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2'
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
            'type'  => Hidden::class,
            'name'  => 'widgetGroupId',
        ]);
    }
}
