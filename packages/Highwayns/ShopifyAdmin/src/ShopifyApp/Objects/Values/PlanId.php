<?php

namespace Highwayns\ShopifyAdmin\Objects\Values;

use Funeralzone\ValueObjects\Scalars\IntegerTrait;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\PlanId as PlanIdValue;

/**
 * Value object for plan's ID.
 */
final class PlanId implements PlanIdValue
{
    use IntegerTrait;
}
