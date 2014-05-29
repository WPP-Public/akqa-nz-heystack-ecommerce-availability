<?php

namespace Heystack\Availability\SilverStripe;

use Heystack\Ecommerce\Locale\Traits\HasLocaleServiceTrait;

/**
 * @package Heystack\Availability\SilverStripe
 */
class AvailabilityExtension extends \DataExtension
{
    use HasLocaleServiceTrait;

    /**
     * @var array
     */
    private static $db = array(
        'NotAvailable' => 'Boolean'
    );

    /**
     * @var array
     */
    private static $many_many = array(
        'AvailabilityZones' => 'Heystack\Zoning\Zone'
    );

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