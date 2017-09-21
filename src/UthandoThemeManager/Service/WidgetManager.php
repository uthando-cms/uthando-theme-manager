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
use UthandoThemeManager\Form\WidgetForm;
use UthandoThemeManager\Hydrator\WidgetHydrator;
use UthandoThemeManager\InputFilter\WidgetInputFilter;
use UthandoThemeManager\Mapper\WidgetMapper;
use UthandoThemeManager\Model\WidgetModel;
use Zend\EventManager\Event;

class WidgetManager extends AbstractRelationalMapperService
{
    protected $form         = WidgetForm::class;
    protected $hydrator     = WidgetHydrator::class;
    protected $inputFilter  = WidgetInputFilter::class;
    protected $mapper       = WidgetMapper::class;
    protected $model        = WidgetModel::class;

    protected $referenceMap = [
        'group' => [
            'refCol'    => 'widgetGroupId',
            'service'   => WidgetGroupManager::class,
        ],
    ];

    protected $tags = [
        'widget',
    ];

    public function attachEvents()
    {
        $this->getEventManager()->attach(self::EVENT_PRE_ADD, [$this, 'setValidation']);
        $this->getEventManager()->attach(self::EVENT_PRE_EDIT, [$this, 'setValidation']);
    }

    public function setValidation(Event $event)
    {
        $form       = $event->getParam('form');
        $model      = $event->getParam('model', new WidgetModel());
        $exclude    = $model->getName() ?: '';

        /* @var WidgetInputFilter $inputFilter */
        $inputFilter = $form->getInputFilter();
        $inputFilter->noRecordExists('name', 'widget', 'name', $exclude);
    }
}
