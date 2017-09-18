<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoThemeManager\Options
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2015 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */
namespace UthandoThemeManager\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class ThemeOptions
 *
 * @package UthandoThemeManager\Options
 */
class ThemeOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $siteName;

    /**
     * @var string
     */
    protected $defaultTheme = 'default';

    /**
     * @var string
     */
    protected $adminTheme = 'admin';

    /**
     * @var string
     */
    protected $themePath = './themes';

    /**
     * @var bool
     */
    protected $bootstrap = true;

    /**
     * @var string
     */
    protected $bootswatchTheme;

    /**
     * @var bool
     */
    protected $fontAwesome = true;

    /**
     * @var bool
     */
    protected $jqueryUi = false;

    /**
     * @var SocialLinksOptions
     */
    protected $socialLinks;

    /**
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * @param string $siteName
     * @return ThemeOptions
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;
        return $this;
    }

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
     * @param $bootstrap
     * @return $this
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
     * @param $bootswatchTheme
     * @return $this
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
     * @param $fontAwesome
     * @return $this
     */
    public function setFontAwesome($fontAwesome)
    {
        $this->fontAwesome = $fontAwesome;
        return $this;
    }

    /**
     * @return bool
     */
    public function getJqueryUi()
    {
        return $this->jqueryUi;
    }

    /**
     * @param $jqueryUi
     * @return $this
     */
    public function setJqueryUi($jqueryUi)
    {
        $this->jqueryUi = $jqueryUi;
        return $this;
    }

    /**
     * @return array
     */
    public function getSocialLinks()
    {
        return $this->socialLinks;
    }

    /**
     * @param array|SocialLinksOptions $socialLinks
     * @return $this
     */
    public function setSocialLinks($socialLinks)
    {
        if ($socialLinks instanceof SocialLinksOptions) {
            $socialLinks = $socialLinks->toArray();
        }

        $this->socialLinks = $socialLinks;
        return $this;
    }

}
