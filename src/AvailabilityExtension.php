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
}