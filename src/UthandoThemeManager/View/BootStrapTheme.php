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
 * Class BootStrapTheme
 *
 * @package UthandoThemeManager\View
 */
class BootStrapTheme extends AbstractViewHelper
{
    const CLOUDFLARE_CDN        = '//cdnjs.cloudflare.com/ajax/libs';

    const BOOTSTRAP_VERSION     = '3.3.7';
    const BOOTSTRAP_PART        = 'twitter-bootstrap';
    const BOOTSTRAP_JS          = 'js/bootstrap.min.js';
    const BOOTSTRAP_CSS         = 'bootstrap.min.css';
    const BOOTSTRAP_THEME_CSS   = 'bootstrap-theme.min.css';

    const BOOTSWATCH_VERSION    = '3.3.7';
    const BOOTSWATCH_PART       = 'bootswatch';

    const FONT_AWESOME_VERSION  = '4.7.0';
    const FONT_AWESOME_PART     = 'font-awesome';
    const FONT_AWESOME_CSS      = 'css/font-awesome.min.css';

    const JQUERY_VERSION        = '3.2.1';
    const JQUERY_PATH           = 'jquery';
    const JQUERY_JS             = 'jquery.min.js';

    const JQUERY_UI_VERSION     = '1.12.1';
    const JQUERY_UI_PATH        = 'jqueryui';
    const JQUERY_UI_JS          = 'jquery-ui.min.js';
    const JQUERY_UI_CSS         = 'jquery-ui.min.css';

    protected $theme = 'default';

    /**
     * @var \UthandoThemeManager\Options\ThemeOptions
     */
    protected $options;

    public function __invoke($theme = null)
    {
        if ($theme) {
            $this->setTheme($theme);
        }

        return $this;
    }

    public function getThemeChooserSelect()
    {

    }

    public function enable()
    {
        $headlinkHelper = $this->view->plugin('headlink');
        $headScriptHelper = $this->view->plugin('headscript');
        $options = $this->getOptions();

        // assemble css and js files from cdn
        if ($options->getBootstrap()) {

            if (!$options->getBootswatchTheme()) {
                $headlinkHelper()->offsetSetStylesheet(0, join('/', [
                    self::CLOUDFLARE_CDN,
                    self::BOOTSTRAP_PART,
                    self::BOOTSTRAP_VERSION,
                    'css',
                    self::BOOTSTRAP_CSS
                ]), 'screen,print');

                $headlinkHelper()->offsetSetStylesheet(1, join('/', [
                    self::CLOUDFLARE_CDN,
                    self::BOOTSTRAP_PART,
                    self::BOOTSTRAP_VERSION,
                    'css',
                    self::BOOTSTRAP_THEME_CSS
                ]), 'screen,print');

            } else {

                $headlinkHelper()->offsetSetStylesheet(0, join('/', [
                    self::CLOUDFLARE_CDN,
                    self::BOOTSWATCH_PART,
                    self::BOOTSWATCH_VERSION,
                    $this->options->getBootswatchTheme(),
                    self::BOOTSTRAP_CSS
                ]), 'screen,print');
            }

            //netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js
            $headScriptHelper()->offsetSetFile(2, join('/', [
                self::CLOUDFLARE_CDN,
                self::BOOTSTRAP_PART,
                self::BOOTSTRAP_VERSION,
                self::BOOTSTRAP_JS
            ]));
        }

        if ($options->getFontAwesome()) {
            $headlinkHelper()->offsetSetStylesheet(2, join('/', [
                self::CLOUDFLARE_CDN,
                self::FONT_AWESOME_PART,
                self::FONT_AWESOME_VERSION,
                self::FONT_AWESOME_CSS
            ]));
        }

        // JS
        //ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js

        $headScriptHelper()->offsetSetFile(0, join('/', [
            self::CLOUDFLARE_CDN,
            self::JQUERY_PATH,
            self::JQUERY_VERSION,
            self::JQUERY_JS
        ]));

        if ($options->getJqueryUi()) {
            $headScriptHelper()->offsetSetFile(1, join('/', [
                self::CLOUDFLARE_CDN,
                self::JQUERY_UI_PATH,
                self::JQUERY_UI_VERSION,
                self::JQUERY_UI_JS
            ]));

            $headlinkHelper()->offsetSetStylesheet(1, join('/', [
                self::CLOUDFLARE_CDN,
                self::JQUERY_UI_PATH,
                self::JQUERY_UI_VERSION,
                self::JQUERY_UI_CSS
            ]));
        }
    }

    /**
     * @return \UthandoThemeManager\Options\ThemeOptions
     */
    public function getOptions()
    {
        if (!$this->options) {
            $options = $this->getServiceLocator()
                ->getServiceLocator()
                ->get('UthandoThemeManager\Options\ThemeOptions');
            $this->options = $options;
        }

        return $this->options;
    }

    public function getTheme()
    {
        return $this->options->getDefaultTheme();
    }

    public function setTheme($theme)
    {
        $this->options->setDefaultTheme($theme);
        return $this;
    }

}
