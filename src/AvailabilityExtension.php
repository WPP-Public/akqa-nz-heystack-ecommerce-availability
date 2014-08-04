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
     * @param string $class
     * @param string $extension
     * @param array $args
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
     * @return void
     */
    public function updateCMSFields(\FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Main',
            new \CheckboxField('NotAvailable', 'Currently Unavailable')
        );
    }
}