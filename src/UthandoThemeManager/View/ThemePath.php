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

use UthandoCommon\View\AbstractViewHelper;

/**
 * Class ThemePath
 *
 * @package UthandoThemeManager\View
 */
class ThemePath extends AbstractViewHelper
{
    public function __invoke($file = null)
    {
        if (null !== $file) {
            $file = ltrim($file, '/');
        }

        $isAdmin = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('Application')
            ->getMvcEvent()
            ->getRouteMatch()
            ->getParam('is-admin');

        $config = $this->getConfig('theme_manager');
        $theme = ($isAdmin) ? $config['admin_theme'] : $config['default_theme'];

        $file = join('/', array(
            'themes',
            $theme,
            $file
        ));

        $basePathHelper = $this->view->plugin('basepath');

        return $basePathHelper($file);
    }
}
