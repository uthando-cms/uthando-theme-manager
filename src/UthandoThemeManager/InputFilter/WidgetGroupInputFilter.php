<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 18/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\InputFilter;


use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\I18n\Validator\IsInt;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Digits;
use Zend\Validator\StringLength;

class WidgetGroupInputFilter extends InputFilter
{
    public function init()
    {
        $this->add([
            'name'      => 'widgetGroupId',
            'required'  => false,
            'filters'   => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
                ['name' => ToInt::class],
            ],
            'validators'    => [
                ['name' => IsInt::class],
            ],
        ]);

        $this->add([
            'name'      => 'name',
            'required'  => true,
            'filters'   => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators'    => [
                ['name' => StringLength::class, 'options' => [
                    'encoding'  => 'UTF-8',
                    'min'       => 5,
                    'max'       => 255,
                ]]
            ]
        ]);
    }
}
