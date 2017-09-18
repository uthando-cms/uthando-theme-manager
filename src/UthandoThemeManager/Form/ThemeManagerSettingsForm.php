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
use UthandoThemeManager\Options\ThemeOptions;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;

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
            'type'      => Text::class,
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
            'type'      => Text::class,
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
            'name'			=> 'bootstrap',
            'type'			=> Checkbox::class,
            'options'		=> [
                'label'			=> 'Enable Bootstrap',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'required' 		=> false,
                'column-size' => 'md-10 col-md-offset-2',
            ],
        ]);

        $this->add([
            'name'      => 'bootswatch_theme',
            'type'      => Text::class,
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
                'required' 		=> false,
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
                'required' 		=> false,
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
                //'use_as_base_fieldset' => true,
                'label' => 'Social Links',
            ],
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [];
    }
}
