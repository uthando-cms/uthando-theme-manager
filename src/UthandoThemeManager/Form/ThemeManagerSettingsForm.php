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
use UthandoThemeManager\Form\Element\BootswatchSelect;
use UthandoThemeManager\Form\Element\ThemeSelect;
use UthandoThemeManager\Options\ThemeOptions;
use Zend\Filter\Boolean;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToNull;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;

class ThemeManagerSettingsForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods())
            ->setObject(new ThemeOptions());
    }

    public function init()
    {
        $this->add([
            'name'      => 'site_name',
            'type'      => Text::class,
            'options'   => [
                'label'             => 'Site Name',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'      => 'default_theme',
            'type'      => ThemeSelect::class,
            'options'   => [
                'label'             => 'Theme',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'      => 'admin_theme',
            'type'      => ThemeSelect::class,
            'options'   => [
                'label'             => 'Admin Theme',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'      => 'theme_path',
            'type'      => Text::class,
            'options'   => [
                'label'             => 'Theme Path',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'      => 'public_dir',
            'type'      => Text::class,
            'options'   => [
                'label'             => 'Public HTML Directory',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'			=> 'bootstrap',
            'type'			=> Checkbox::class,
            'options'		=> [
                'label'			=> 'Enable Bootstrap',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'column-size' => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'name'      => 'bootswatch_theme',
            'type'      => BootswatchSelect::class,
            'options'   => [
                'label'             => 'Bootswatch Theme',
                'twb-layout'        => TwbBundleForm::LAYOUT_HORIZONTAL,
                'column-size'       => 'md-10',
                'label_attributes'  => [
                    'class' => 'col-md-2',
                ],
            ],
        ]);

        $this->add([
            'name'			=> 'font_awesome',
            'type'			=> Checkbox::class,
            'options'		=> [
                'label'			=> 'Enable Font Awesome',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'column-size' => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'name'			=> 'jquery_ui',
            'type'			=> Checkbox::class,
            'options'		=> [
                'label'			=> 'Enable JQuery UI',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'column-size' => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'name'			=> 'cache',
            'type'			=> Checkbox::class,
            'options'		=> [
                'label'			=> 'Cache Theme Assets',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'column-size' => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'name'			=> 'compress_javascript',
            'type'			=> Checkbox::class,
            'options'		=> [
                'label'			=> 'Compress JavaScript',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'column-size' => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'name'			=> 'compress_css',
            'type'			=> Checkbox::class,
            'options'		=> [
                'label'			=> 'Compress CSS',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'column-size' => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'type' => SocialLinksFieldSet::class,
            'name' => 'social_links',
            'attributes' => [
                'class' => 'col-md-12',
            ],
            'options' => [
                'label' => 'Social Links',
            ],
        ]);

        // load in default values
        $defaultOptions = $this->getObject()->toArray();

        foreach ($defaultOptions as $key => $value) {
            if ($this->has($key)) {
                $this->get($key)->setValue($value);
            }
        }
    }

    public function getInputFilterSpecification(): array
    {
        return [
            'site_name' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                ],
                'validators' => [
                    ['name' => StringLength::class, 'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 255,
                    ]],
                ],
            ],
            'default_theme' => [
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
            'admin_theme' => [
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
            'theme_path' => [
                'required' => false,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                ],
                'validators' => [
                    ['name' => StringLength::class, 'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ]],
                ],
            ],
            'public_dir' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                ],
                'validators' => [
                    ['name' => StringLength::class, 'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ]],
                ],
            ],
            'bootstrap' => [
                'required' => false,
                'allow_empty' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                    ['name' => Boolean::class],
                ],
            ],
            'bootswatch_theme' => [
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
            'font_awesome' => [
                'required' => false,
                'allow_empty' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                    ['name' => Boolean::class],
                ],
            ],
            'cache' => [
                'required' => false,
                'allow_empty' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                    ['name' => Boolean::class],
                ],
            ],
            'compress_javascript' => [
                'required' => false,
                'allow_empty' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                    ['name' => Boolean::class],
                ],
            ],
            'compress_css' => [
                'required' => false,
                'allow_empty' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                    ['name' => Boolean::class],
                ],
            ],
            'jquery_ui' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class,],
                    ['name' => Boolean::class],
                ],
            ],
        ];
    }
}
