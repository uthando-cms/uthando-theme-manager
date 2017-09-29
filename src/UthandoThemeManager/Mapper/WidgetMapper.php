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
use UthandoThemeManager\Model\WidgetModel;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Select;

class WidgetMapper extends AbstractDbMapper
{
    protected $table = 'widget';
    protected $primary = 'widgetId';

    public function getWidgetByName(string $name): WidgetModel
    {
        $select = $this->getSelect();
        $select->where
            ->equalTo('name', $name)
            ->and->equalTo('enabled', 1);

        $rowSet = $this->fetchResult($select);
        $row = $rowSet->current();

        return $row;
    }

    public function getWidgetsByGroupId(int $id): HydratingResultSet
    {
        $select = $this->getSelect();
        $select->where
            ->equalTo('widgetGroupId', $id)
            ->and->equalTo('enabled', 1);
        $select->order('sortOrder ' . Select::ORDER_ASCENDING);

        $rowSet = $this->fetchResult($select);
        return $rowSet;
    }
}
