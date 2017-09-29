<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 18/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoThemeManager\Mapper;

use UthandoCommon\Mapper\AbstractDbMapper;
use UthandoThemeManager\Model\WidgetGroupModel;

class WidgetGroupMapper extends AbstractDbMapper
{
    protected $table = 'widgetGroup';
    protected $primary = 'widgetGroupId';

    public function getWidgetGroupByName(string $name)
    {
        $select = $this->getSelect();
        $select->where->equalTo('name', $name);

        $rowSet = $this->fetchResult($select);
        $row = $rowSet->current();

        return $row;
    }
}
