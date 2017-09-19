<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 19/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Form\Element;


use UthandoThemeManager\Options\ThemeOptions;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class ThemeSelect extends Select implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $emptyOption = 'Default';

    public function init()
    {
        /** @var ThemeOptions $themeOptions */
        $themeOptions   = $this->getServiceLocator()
            ->getServiceLocator()
            ->get(ThemeOptions::class);
        $themePath      = $themeOptions->getThemePath();
        $themes         = scandir($themePath);
        $optionsList    = [];

        foreach ($themes as $theme) {

            if ($theme == '.' || $theme == '..') continue;

            $optionsList[] = [
                'label' => mb_convert_case(str_replace('-', ' ', $theme), MB_CASE_TITLE),
                'value' => $theme,
            ];
        }

        $this->setValueOptions($optionsList);
    }
}
