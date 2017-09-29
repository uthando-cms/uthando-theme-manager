<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 18/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Options;

use Zend\Stdlib\AbstractOptions;

class SocialLinksOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $facebook;

    /**
     * @var string
     */
    protected $twitter;

    /**
     * @var string
     */
    protected $rss;

    /**
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param string $facebook
     * @return SocialLinksOptions
     */
    public function setFacebook(string $facebook): SocialLinksOptions
    {
        $this->facebook = $facebook;
        return $this;
    }

    /**
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param string $twitter
     * @return SocialLinksOptions
     */
    public function setTwitter(string $twitter): SocialLinksOptions
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * @return string
     */
    public function getRss()
    {
        return $this->rss;
    }

    /**
     * @param string $rss
     * @return SocialLinksOptions
     */
    public function setRss(string $rss): SocialLinksOptions
    {
        $this->rss = $rss;
        return $this;
    }
}
