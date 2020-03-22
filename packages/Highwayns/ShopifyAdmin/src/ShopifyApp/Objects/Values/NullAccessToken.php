<?php

namespace Highwayns\ShopifyAdmin\Objects\Values;

use Funeralzone\ValueObjects\NullTrait;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\AccessToken as AccessTokenValue;

/**
 * Value object for access token (null).
 */
final class NullAccessToken implements AccessTokenValue
{
    use NullTrait;

    /**
     * {@inheritdoc}
     */
    public function isEmpty(): bool
    {
        return true;
    }
}
