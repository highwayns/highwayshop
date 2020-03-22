<?php

namespace Highwayns\ShopifyAdmin\Objects\Transfers;

use Highwayns\ShopifyAdmin\Contracts\Objects\Values\AccessToken as AccessTokenValue;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\ShopDomain as ShopDomainValue;

/**
 * Reprecents details for API session used by API helper.
 */
final class ApiSession extends AbstractTransfer
{
    /**
     * The shop's domain.
     *
     * @var ShopDomainValue
     */
    public $domain;

    /**
     * The access token.
     *
     * @var AccessTokenValue
     */
    public $token;
}
