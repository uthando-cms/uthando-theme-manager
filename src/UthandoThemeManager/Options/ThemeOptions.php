<?php
namespace UthandoThemeManager\Options;

use Zend\Stdlib\AbstractOptions;

class ThemeOptions extends AbstractOptions
{
    protected $__strictMode__ = false;
    /**
     * @var string
     */
    protected $defaultTheme;
    
    /**
     * @var string
     */
    protected $adminTheme;
    
    /**
     * @var string
     */
    protected $themePath;
    
    /**
     * @var bool
     */
    protected $bootstrap;
    
    /**
     * @var string
     */
    protected $bootswatchTheme;
    
    /**
     * @var bool
     */
    protected $fontAwesome;
    
	/**
	 * @return string $defaultTheme
	 */
	public function getDefaultTheme()
	{
		return $this->defaultTheme;
	}

	/**
	 * @param string $defaultTheme
	 * @return \UthandoThemeManager\Options\ThemeOptions
	 */
	public function setDefaultTheme($defaultTheme)
	{
		$this->defaultTheme = $defaultTheme;
		return $this;
	}

	/**
	 * @return string $adminTheme
	 */
	public function getAdminTheme()
	{
		return $this->adminTheme;
	}

	/**
	 * @param string $adminTheme
	 * @return \UthandoThemeManager\Options\ThemeOptions
	 */
	public function setAdminTheme($adminTheme)
	{
		$this->adminTheme = $adminTheme;
		return $this;
	}

	/**
	 * @return string $themePath
	 */
	public function getThemePath()
	{
		return $this->themePath;
	}

	/**
	 * @param string $themePath
	 * @return \UthandoThemeManager\Options\ThemeOptions
	 */
	public function setThemePath($themePath)
	{
		$this->themePath = $themePath;
		return $this;
	}

	/**
	 * @return bool $bootstrap
	 */
	public function getBootstrap()
	{
		return $this->bootstrap;
	}

	/**
	 * @param unknown $bootstrap
	 * @return \UthandoThemeManager\Options\ThemeOptions
	 */
	public function setBootstrap($bootstrap)
	{
		$this->bootstrap = $bootstrap;
		return $this;
	}

	/**
	 * @return string $bootswatchTheme
	 */
	public function getBootswatchTheme()
	{
		return $this->bootswatchTheme;
	}

	/**
	 * @param unknown $bootswatchTheme
	 * @return \UthandoThemeManager\Options\ThemeOptions
	 */
	public function setBootswatchTheme($bootswatchTheme)
	{
		$this->bootswatchTheme = $bootswatchTheme;
		return $this;
	}
	
	/**
	 * @return bool $fontAwesome
	 */
	public function getFontAwesome()
	{
		return $this->fontAwesome;
	}

	/**
	 * @param boolean $fontAwesome
	 */
	public function setFontAwesome($fontAwesome)
	{
		$this->fontAwesome = $fontAwesome;
		return $this;
	}

}
