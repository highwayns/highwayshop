<?php

namespace Highwayns\ShopifyAdmin\Objects\Values;

use Funeralzone\ValueObjects\Scalars\StringTrait;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\AccessToken as AccessTokenValue;

/**
 * Value object for shop's offline access token.
 */
final class AccessToken implements AccessTokenValue
{
    use StringTrait;

    /**
     * {@inheritdoc}
     */
    public function isEmpty(): bool
    {
        return empty($this->toNative());
    }
}
