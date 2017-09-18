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

class WidgetGroupManager extends AbstractMapperService
{
    protected $form         = WidgetGroupForm::class;
    protected $hydrator     = WidgetGroupHydrator::class;
    protected $inputFilter  = WidgetGroupInputFilter::class;
    protected $mapper       = WidgetGroupMapper::class;
    protected $model        = WidgetGroupModel::class;
}
