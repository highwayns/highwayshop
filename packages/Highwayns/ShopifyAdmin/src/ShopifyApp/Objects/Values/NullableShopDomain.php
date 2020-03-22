<?php

namespace Highwayns\ShopifyAdmin\Objects\Values;

use Funeralzone\ValueObjects\Nullable;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\ShopDomain as ShopDomainValue;

/**
 * Value object for the shop's domain (nullable).
 */
final class NullableShopDomain extends Nullable implements ShopDomainValue
{
    /**
     * @return string
     */
    protected static function nonNullImplementation(): string
    {
        return ShopDomain::class;
    }

    /**
     * @return string
     */
    protected static function nullImplementation(): string
    {
        return NullShopDomain::class;
    }
}
