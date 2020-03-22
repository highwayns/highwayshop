<?php

namespace Highwayns\ShopifyAdmin\Objects\Values;

use Funeralzone\ValueObjects\NullTrait;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\PlanId as PlanIdValue;

/**
 * Value object for plan's ID (null).
 */
final class NullPlanId implements PlanIdValue
{
    use NullTrait;
}
