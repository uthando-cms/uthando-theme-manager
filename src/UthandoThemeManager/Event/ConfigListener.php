<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 19/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Event;


use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\ModuleManager\ModuleEvent;
use Zend\Stdlib\ArrayUtils;

class ConfigListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(ModuleEvent::EVENT_MERGE_CONFIG, [$this, 'onMergeConfig'], 1);
    }

    /**
     * @param ModuleEvent $event
     * @return ConfigListener
     */
    public function onMergeConfig(ModuleEvent $event)
    {
        $configListener     = $event->getConfigListener();
        $config             = $configListener->getMergedConfig(false);
        $loadThemePath      = $config['asset_manager']['resolver_configs']['paths']['ThemeManager'] ?: false;

        if (false !== $loadThemePath) return $this;

        $themePath = $config['uthando_theme_manager']['theme_path'] ?: null;
        $assetManager['asset_manager']['resolver_configs']['paths']['ThemeManager'] = $themePath;

        $config = ArrayUtils::merge($config, $assetManager);
        // Pass the changed configuration back to the listener:
        $configListener->setMergedConfig($config);

        return $this;
    }
}
