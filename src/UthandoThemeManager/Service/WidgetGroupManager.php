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

use UthandoCommon\Service\AbstractMapperService;
use UthandoThemeManager\Form\WidgetGroupForm;
use UthandoThemeManager\Hydrator\WidgetGroupHydrator;
use UthandoThemeManager\InputFilter\WidgetGroupInputFilter;
use UthandoThemeManager\Mapper\WidgetGroupMapper;
use UthandoThemeManager\Model\WidgetGroupModel;
use Zend\EventManager\Event;

class WidgetGroupManager extends AbstractMapperService
{
    protected $form         = WidgetGroupForm::class;
    protected $hydrator     = WidgetGroupHydrator::class;
    protected $inputFilter  = WidgetGroupInputFilter::class;
    protected $mapper       = WidgetGroupMapper::class;
    protected $model        = WidgetGroupModel::class;

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
}
