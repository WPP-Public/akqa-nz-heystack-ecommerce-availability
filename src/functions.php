<?php

namespace Heystack\Availability;

use DataList;

/**
 * @param \DataList $list
 * @param $zoneName
 * @return \DataList
 */
function filter_by_availability(DataList $list, $zoneName) {
    return $list
        ->filter('NotAvailable', 0)
        ->filter('AvailabilityZones.Name', $zoneName);
}