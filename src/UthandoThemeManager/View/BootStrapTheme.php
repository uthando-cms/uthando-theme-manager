<?php
namespace UthandoThemeManager\View;

use UthandoCommon\View\AbstractViewHelper;

class BootStrapTheme extends AbstractViewHelper
{
    const BOOTSTRAP_VERSION = '3.1.1';
    const BOOTSTRAP_PART = 'bootstrap';
    const BOOTSWATCH_PART = 'bootswatch';
    const BOOTSTRAP_CDN = '//netdna.bootstrapcdn.com';
    const BOOTSTRAP_THEME_CSS = 'bootstrap-theme.min.css';
    const BOOTSTRAP_CSS = 'bootstrap.min.css';
    const BOOTSTRAP_JS = 'js/bootstrap.min.js';
    
    const GOOGLE_AJAX_API = '//ajax.googleapis.com';
    const JQUERY_PATH = 'ajax/libs/jquery';
    const JQUERY_VERSION = '2.0.3';
    const JQUERY_JS = 'jquery.min.js';
    
    const FONT_AWESOME_CSS = 'css/font-awesome.css';
    const FONT_AWESOME_PART = 'font-awesome';
    const FONT_AWESOME_VERSION = '4.0.3';
    
    //netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css
    
    protected $theme = 'default';
    
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
    
    public function getThemeFromConfig()
    {
        $config = $this->getConfig('theme_manager');
    }
    
    public function enable()
    {
        $headlinkHelper = $this->view->plugin('headlink');
        $headScriptHelper = $this->view->plugin('headscript');
        
        // assemble css and js files from cdn
        if ('default' === $this->getTheme()) {
            //netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css
            $headlinkHelper()->offsetSetStylesheet(0, join('/', [
                self::BOOTSTRAP_CDN,
                self::BOOTSTRAP_PART,
                self::BOOTSTRAP_VERSION,
                'css',
                self::BOOTSTRAP_CSS
            ]));
            
            $headlinkHelper()->offsetSetStylesheet(1, join('/', [
        		self::BOOTSTRAP_CDN,
        		self::BOOTSTRAP_PART,
        		self::BOOTSTRAP_VERSION,
                'css',
        		self::BOOTSTRAP_THEME_CSS
            ]));
            
        } else {
            //netdna.bootstrapcdn.com/bootswatch/3.1.1/simplex/bootstrap.min.css
            $headlinkHelper()->offsetSetStylesheet(0, join('/', [
        		self::BOOTSTRAP_CDN,
        		self::BOOTSWATCH_PART,
        		self::BOOTSTRAP_VERSION,
        		$this->getTheme(),
        		self::BOOTSTRAP_CSS
            ]));
        }
        
        // JS
        //ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js
        //netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js
        
        $headScriptHelper()->offsetSetFile(0, join('/', [
    		self::GOOGLE_AJAX_API,
    		self::JQUERY_PATH,
    		self::JQUERY_VERSION,
    		self::JQUERY_JS
        ]));
        
        $headScriptHelper()->offsetSetFile(1, join('/', [
    		self::BOOTSTRAP_CDN,
    		self::BOOTSTRAP_PART,
    		self::BOOTSTRAP_VERSION,
    		self::BOOTSTRAP_JS
        ]));
    }
    
	public function getTheme()
	{
		return $this->theme;
	}

	public function setTheme($theme)
	{
		$this->theme = $theme;
		return $this;
	}

}
