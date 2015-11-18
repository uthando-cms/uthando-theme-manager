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

use UthandoCommon\Stdlib\StringUtils;
use UthandoCommon\View\AbstractViewHelper;

/**
 * Class SocialLinks
 *
 * @package UthandoThemeManager\View
 */
class SocialLinks extends AbstractViewHelper
{
    public function __invoke()
    {
        $config = $this->getConfig('theme_manager');

        if (isset($config['social_links']) && is_array($config['social_links'])) {
            return $this->render($config['social_links']);
        }

        return '';
    }

    public function render(array $links)
    {
        $html = "";
        $urlHelper = $this->getView()->plugin('url');

        foreach ($links as $key => $value) {
            if (!StringUtils::startsWith($value, 'http')) {
                $value = $urlHelper($value);
            }
            $html .= '<a href="' . $value . '" class="social fa fa-' . $key . '"></a>' . PHP_EOL;
        }

        return $html;
    }
} 