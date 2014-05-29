<?php

namespace Heystack\Availability\SilverStripe;

use Heystack\Core\Exception\ConfigurationException;
use Heystack\Ecommerce\Locale\Interfaces\ZoneServiceInterface;
use Heystack\Ecommerce\Zone\Traits\HasZoneServiceTrait;

/**
 * @package Heystack\Availability\SilverStripe
 */
trait AvailabilityTrait
{
    use HasZoneServiceTrait;

    /**
     * @return bool
     * @throws \Heystack\Core\Exception\ConfigurationException
     */
    public function isAvailable()
    {
        if (!$this instanceof \DataObject) {
            throw new ConfigurationException(
                sprintf(
                    "'%s' is not an instance of DataObject",
                    __CLASS__
                )
            );
        }
 
        if ($this->getField('NotAvailable')) {
            return false;
        }
        
        if (!$this->zoneService instanceof ZoneServiceInterface) {
            throw new ConfigurationException(
                sprintf(
                    "%s::isAvailable expected to have a zone service but not was set on trait",
                    __CLASS__
                )
            );
        }

        return array_key_exists(
            $this->zoneService->getActiveZone()->getName(),
            $this->getComponents('AvailabilityZones')->column('Name')
        );
    }
}