<?php

namespace Highwayns\ShopifyAdmin\Objects\Values;

use Funeralzone\ValueObjects\NullTrait;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\ShopDomain as ShopDomainValue;

/**
 * Value object for the shop's domain (null).
 */
final class NullShopDomain implements ShopDomainValue
{
    use NullTrait;
}
