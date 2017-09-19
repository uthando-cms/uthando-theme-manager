<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 19/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Form\Element;


use UthandoThemeManager\Model\WidgetGroupModel;
use UthandoThemeManager\Service\WidgetGroupManager;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class WidgetGroupSelect extends Select implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $emptyOption = '---Select a group---';

    public function setOptions($options)
    {
        parent::setOptions($options);

        if (array_key_exists('empty_option', $options)) {
            $this->setEmptyOption($options['empty_option']);
        }
    }

    public function getValueOptions()
    {
        $options = $this->valueOptions ?? $this->getOptionList();
        return $options;
    }

    public function getOptionList()
    {
        /** @var WidgetGroupManager $widgetGroupManager */
        $widgetGroupManager = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('UthandoServiceManager')
            ->get(WidgetGroupManager::class);

        $widgetGroupManager->getMapper();
        $groups = $widgetGroupManager->fetchAll();

        $groupOptions = [];

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
