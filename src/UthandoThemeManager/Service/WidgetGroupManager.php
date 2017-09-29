<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 18/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Service;

use UthandoCommon\Service\AbstractRelationalMapperService;
use UthandoThemeManager\Form\WidgetGroupForm;
use UthandoThemeManager\Hydrator\WidgetGroupHydrator;
use UthandoThemeManager\InputFilter\WidgetGroupInputFilter;
use UthandoThemeManager\Mapper\WidgetGroupMapper;
use UthandoThemeManager\Model\WidgetGroupModel;
use Zend\EventManager\Event;

/**
 * Class WidgetGroupManager
 * @package UthandoThemeManager\Service
 * @method WidgetGroupMapper getMapper($mapperClass = null, array $options = [])
 */
class WidgetGroupManager extends AbstractRelationalMapperService
{
    protected $form         = WidgetGroupForm::class;
    protected $hydrator     = WidgetGroupHydrator::class;
    protected $inputFilter  = WidgetGroupInputFilter::class;
    protected $mapper       = WidgetGroupMapper::class;
    protected $model        = WidgetGroupModel::class;

    protected $referenceMap = [
        'widgets' => [
            'refCol'    => 'widgetGroupId',
            'getMethod' => 'getWidgetsByGroupId',
            'service'   => WidgetManager::class,
        ],
    ];

    protected $tags = [
        'widget', 'widget-group',
    ];

    public function attachEvents()
    {
        $this->getEventManager()->attach(self::EVENT_PRE_ADD, [$this, 'setValidation']);
        $this->getEventManager()->attach(self::EVENT_PRE_EDIT, [$this, 'setValidation']);
    }

    public function setValidation(Event $event)
    {
        $form       = $event->getParam('form');
        $model      = $event->getParam('model', new WidgetGroupModel());
        $exclude    = $model->getName() ?: '';

        /* @var WidgetGroupInputFilter $inputFilter */
        $inputFilter = $form->getInputFilter();
        $inputFilter->noRecordExists('name', 'widgetGroup', 'name', $exclude);
    }

    /**
     * @param $name
     * @return WidgetGroupModel|null
     */
    public function getWidgetGroupByName($name)
    {
        $widgetGroup = $this->getCacheItem($name);

        if (!$widgetGroup) {
            $widgetGroup = $this->getMapper()->getWidgetGroupByName($name);

            if ($widgetGroup instanceof WidgetGroupModel) {
                $this->populate($widgetGroup, true);
            }

            if ($this->useCache) {
                $this->setCacheItem($name, $widgetGroup);
            }
        }

        return $widgetGroup;
    }
}
