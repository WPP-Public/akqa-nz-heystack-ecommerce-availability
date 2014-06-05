<?php

namespace Heystack\Availability;

use Controller;
use Heystack\Ecommerce\Locale\Traits\HasZoneServiceTrait;
use Versioned;
use LeftAndMain;
use DataExtension;

/**
 * @package Heystack\Availability
 */
class AvailabilityExtension extends DataExtension
{
    use HasZoneServiceTrait;

    /**
     * @param $class
     * @param $extension
     * @param $args
     * @return array
     */
    public static function get_extra_config($class, $extension, $args)
    {
        return [
            'db' => [
                'NotAvailable' => 'Boolean'
            ],
            'many_many' => [
                'AvailabilityZones' => 'Heystack\\DB\\Zone'
            ]
        ];
    }

    /**
     * @param \FieldList $fields
     */
    public function updateCMSFields(\FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Main',
            new \CheckboxField('NotAvailable', 'Currently Unavailable')
        );
    }

    /**
     * Change the SQL to ensure that products that aren't available aren't selected
     * @param \SQLQuery $query
     */
    public function augmentSQL(\SQLQuery &$query)
    {
        $controller = Controller::curr();

        if ($controller && !$controller instanceof LeftAndMain) {

            $productTable = get_class($this->owner);
            $siteTreeTableMatch = sprintf(
                'SiteTree%s.ID',
                Versioned::current_stage() === 'Live' ? '_Live' : ''
            );

            // left join on ID and select on availability
            $query->addLeftJoin("{$productTable}_AvailabilityZones", "{$productTable}_AvailabilityZones.{$productTable}ID = $siteTreeTableMatch");
            $query->addLeftJoin( 'Heystack\DB\Zone', $productTable . '_AvailabilityZones.`Heystack\DB\ZoneID` = z.ID', 'z');
            $query->addWhere(sprintf(
                "z.Name = '%s'",
                \Convert::raw2sql($this->zoneService->getActiveZone()->getName())
            ));
            $query->addWhere("NotAvailable != 1");
        }
    }
}