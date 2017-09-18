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
use UthandoThemeManager\Model\WidgetGroupModel;
use UthandoThemeManager\Model\WidgetModel;

class WidgetManager extends AbstractRelationalMapperService
{
    protected $form         = WidgetForm::class;
    protected $hydrator     = WidgetHydrator::class;
    protected $inputFilter  = WidgetInputFilter::class;
    protected $mapper       = WidgetMapper::class;
    protected $model        = WidgetModel::class;
    protected $referenceMap = [
        WidgetGroupModel::class => [
            'refCol'    => 'widgetGroupId',
            'service'   => WidgetGroupManager::class,
        ],
    ];
}
