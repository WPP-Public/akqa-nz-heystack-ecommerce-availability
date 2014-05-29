<?php

namespace Heystack\Availability;

/**
 * @package Heystack\Availability
 */
interface AvailabilityInterface
{
    /**
     * @return mixed
     */
    public function isAvailable();
}