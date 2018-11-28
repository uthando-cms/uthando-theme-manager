<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 19/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Event;


use AssetManager\Cache\FilePathCache;
use UthandoThemeManager\Filter\CssMinFilter;
use UthandoThemeManager\Filter\JsMinFilter;
use UthandoThemeManager\Options\ThemeOptions;
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

    public function onMergeConfig(ModuleEvent $event): ConfigListener
    {
        $configListener     = $event->getConfigListener();
        $config             = $configListener->getMergedConfig(false);
        $options            = new ThemeOptions($config['uthando_theme_manager'] ?? []);
        $assetManager       = [];

        if ($options->getCache()) {
            $assetManager['asset_manager']['caching']['default'] = [
                'cache' => FilePathCache::class,
                'options' => [
                    'dir' => $options->getPublicDir(),
                ],
            ];
        }

        if ($options->isCompressCss()) {
            $assetManager['asset_manager']['filters']['css'][] = [
                'filter' => CssMinFilter::class,
            ];
        }

        if ($options->isCompressCss()) {
            $assetManager['asset_manager']['filters']['js'][] = [
                'filter' => JSMinFilter::class,
            ];
        }

        if ($options->getThemePath()) {
            $assetManager['asset_manager']['resolver_configs']['paths']['ThemeManager'] = $options->getThemePath();
        }

        $config = ArrayUtils::merge($config, $assetManager);

        $configListener->setMergedConfig($config);

        return $this;
    }
}
