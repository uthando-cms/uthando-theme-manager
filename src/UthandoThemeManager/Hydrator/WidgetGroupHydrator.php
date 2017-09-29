<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 18/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Hydrator;

use UthandoCommon\Hydrator\AbstractHydrator;
use UthandoThemeManager\Model\WidgetGroupModel;

class WidgetGroupHydrator extends AbstractHydrator
{
    /**
     * @param WidgetGroupModel $object
     * @return array
     */
    public function extract($object): array
    {
        return [
            'widgetGroupId' => $object->getWidgetGroupId(),
            'name'          => $object->getName(),
        ];
    }
}
