<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 17/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Controller;

use UthandoCommon\Controller\SettingsTrait;
use UthandoThemeManager\View\ThemeOptionsHelper;
use Zend\Mvc\Controller\AbstractActionController;

class Settings extends AbstractActionController
{
    use SettingsTrait;

    public function __construct()
    {
        $this->setFormName(ThemeOptionsHelper::class)
            ->setConfigKey('uthando_theme_manager');
    }
}