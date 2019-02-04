<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 19/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Form\Element;

use UthandoCommon\Service\ServiceManager;
use UthandoThemeManager\Model\WidgetGroupModel;
use UthandoThemeManager\Service\WidgetGroupManager;
use Zend\Form\Element\Select;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class WidgetGroupSelect
 * @package UthandoThemeManager\Form\Element
 * @method AbstractPluginManager getServiceLocator()
 */
class WidgetGroupSelect extends Select implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function setOptions($options)
    {
        parent::setOptions($options);

        if (array_key_exists('empty_option', $options)) {
            $this->setEmptyOption($options['empty_option']);
        }
    }

    public function getValueOptions(): array
    {
        $options = $this->valueOptions ?: $this->getOptionList();
        return $options;
    }

    public function getOptionList(): array
    {
        /** @var WidgetGroupManager $widgetGroupManager */
        $widgetGroupManager = $this->getServiceLocator()
            ->getServiceLocator()
            ->get(ServiceManager::class)
            ->get(WidgetGroupManager::class);

        $widgetGroupManager->getMapper();
        $groups = $widgetGroupManager->fetchAll();

        $groupOptions = [
            [
                'label' => 'Unassigned',
                'value' => 0,
            ]
        ];

        /* @var $group WidgetGroupModel */
        foreach($groups as $group) {
            $groupOptions[] = [
                'label' => $group->getName(),
                'value' => $group->getWidgetGroupId(),
            ];
        }

        return $groupOptions;
    }
}
