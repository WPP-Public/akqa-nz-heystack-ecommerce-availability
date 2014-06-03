<?php

namespace Heystack\Availability\SilverStripe;

use Heystack\Core\Exception\ConfigurationException;
use Heystack\Ecommerce\Locale\Interfaces\ZoneServiceInterface;
use Heystack\Ecommerce\Locale\Traits\HasZoneServiceTrait;

/**
 * @package Heystack\Availability\SilverStripe
 */
trait AvailabilityTrait
{
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
        
        $zoneService = $this->getZoneService();
        
        if (!$zoneService instanceof ZoneServiceInterface) {
            throw new ConfigurationException(
                sprintf(
                    "%s::isAvailable expected to have a zone service but not was set on trait",
                    __CLASS__
                )
            );
        }

        return array_key_exists(
            $zoneService->getActiveZone()->getName(),
            $this->AvailabilityZones()->column('Name')
        );
    }

    /**
     * @return \Heystack\Ecommerce\Locale\Interfaces\ZoneServiceInterface
     */
    abstract function getZoneService();
}