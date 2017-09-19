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
use UthandoThemeManager\Options\SocialLinksOptions;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToNull;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;

class SocialLinksFieldSet extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods())
            ->setObject(new SocialLinksOptions());
    }

    public function init()
    {
        $this->add([
            'name'      => 'facebook',
            'type'      => Text::class,
            'options'   => [
                'label'             => 'Facebook',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'      => 'twitter',
            'type'      => Text::class,
            'options'   => [
                'label'             => 'Twitter',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'      => 'rss',
            'type'      => Text::class,
            'options'   => [
                'label'             => 'RSS',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'facebook' => [
                'required' => false,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                    ['name' => ToNull::class],
                ],
                'validators' => [
                    ['name' => StringLength::class, 'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 255,
                    ]],
                ],
            ],
            'twitter' => [
                'required' => false,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                    ['name' => ToNull::class],
                ],
                'validators' => [
                    ['name' => StringLength::class, 'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 255,
                    ]],
                ],
                'rss' => [
                    'required' => false,
                    'filters' => [
                        ['name' => StringTrim::class],
                        ['name' => StripTags::class,],
                        ['name' => ToNull::class],
                    ],
                    'validators' => [
                        ['name' => StringLength::class, 'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 255,
                        ]],
                    ],
                ],
            ],
        ];
    }
}
