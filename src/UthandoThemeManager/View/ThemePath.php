<?php
namespace UthandoThemeManager\View;

use UthandoCommon\View\AbstractViewHelper;

class ThemePath extends AbstractViewHelper
{
    public function __invoke($file = null)
    {   
    	if (null !== $file) {
    		$file = ltrim($file, '/');
    	}
    	
    	$config = $this->getConfig('theme_manager');
    	$theme = $config['default_theme'];
    	$themePath = trim(ltrim(strstr($config['theme_path'], 'public'), 'public'), '/');
    	
    	
    	$file = join('/', array(
    		$themePath,
    	    $theme,
    	    $file
    	));
    	
    	$basePathHelper = $this->view->plugin('basepath');
    
    	return $basePathHelper($file);
    }
}
