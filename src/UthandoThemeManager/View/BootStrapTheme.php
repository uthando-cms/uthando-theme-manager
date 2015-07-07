<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoThemeManager\View
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
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
    const BOOTSTRAP_VERSION = '3.3.5';
    const BOOTSWATCH_VERSION = '3.3.4';
    const BOOTSTRAP_PART = 'bootstrap';
    const BOOTSWATCH_PART = 'bootswatch';
    const BOOTSTRAP_CDN = '//maxcdn.bootstrapcdn.com';
    const BOOTSTRAP_THEME_CSS = 'bootstrap-theme.min.css';
    const BOOTSTRAP_CSS = 'bootstrap.min.css';
    const BOOTSTRAP_JS = 'js/bootstrap.min.js';
    
    const GOOGLE_AJAX_API = '//ajax.googleapis.com';
    const JQUERY_PATH = 'ajax/libs/jquery';
    const JQUERY_VERSION = '2.1.4';
    const JQUERY_JS = 'jquery.min.js';
    
    const FONT_AWESOME_CSS = 'css/font-awesome.css';
    const FONT_AWESOME_PART = 'font-awesome';
    const FONT_AWESOME_VERSION = '4.3.0';
    
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
    
    public function enable()
    {
        $headlinkHelper = $this->view->plugin('headlink');
        $headScriptHelper = $this->view->plugin('headscript');
        $options = $this->getOptions();
        
        // assemble css and js files from cdn
        if ($options->getBootstrap()) {
            
            $headlinkHelper()->offsetSetStylesheet(0, join('/', [
                self::BOOTSTRAP_CDN,
                self::BOOTSTRAP_PART,
                self::BOOTSTRAP_VERSION,
                'css',
                self::BOOTSTRAP_CSS
            ]), 'screen,print');
            
            if (!$options->getBootswatchTheme()) {
                $headlinkHelper()->offsetSetStylesheet(1, join('/', [
            		self::BOOTSTRAP_CDN,
            		self::BOOTSTRAP_PART,
            		self::BOOTSTRAP_VERSION,
                    'css',
            		self::BOOTSTRAP_THEME_CSS
                ]), 'screen,print');
            
            } else {
                
                $headlinkHelper()->offsetSetStylesheet(0, join('/', [
            		self::BOOTSTRAP_CDN,
            		self::BOOTSWATCH_PART,
            		self::BOOTSWATCH_VERSION,
            		$this->options->getBootswatchTheme(),
            		self::BOOTSTRAP_CSS
                ]), 'screen,print');
            }
            
            //netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js
            $headScriptHelper()->offsetSetFile(1, join('/', [
        		self::BOOTSTRAP_CDN,
        		self::BOOTSTRAP_PART,
        		self::BOOTSTRAP_VERSION,
        		self::BOOTSTRAP_JS
            ]));
        }
        
        if ($options->getFontAwesome()) {
            $headlinkHelper()->offsetSetStylesheet(2, join('/', [
    		  self::BOOTSTRAP_CDN,
    		  self::FONT_AWESOME_PART,
    		  self::FONT_AWESOME_VERSION,
    		  self::FONT_AWESOME_CSS
    		]));
        }
        
        // JS
        //ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js
        
        $headScriptHelper()->offsetSetFile(0, join('/', [
    		self::GOOGLE_AJAX_API,
    		self::JQUERY_PATH,
    		self::JQUERY_VERSION,
    		self::JQUERY_JS
		]));
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
