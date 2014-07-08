<?php
namespace UthandoThemeManager\Service;

use UthandoThemeManager\Options\ThemeOptions as Options;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ThemeOptionsFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
	    $options = isset($config['theme_manager']) ? $config['theme_manager'] : [];
	    
	    return new Options($options);
		
	}
}
