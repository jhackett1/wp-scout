<?php

/** human-readable string for approximate distance away in miles */
function prettyDistanceAway(float $distance): string
{
    $rounded_distance = round($distance);

    if ($rounded_distance == 0) return "Less than a mile away";
    if ($rounded_distance == 1) return "About a mile away";
    return "{$rounded_distance} miles away";
}
