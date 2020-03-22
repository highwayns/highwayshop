<?php

namespace Highwayns\ShopifyAdmin\Objects\Transfers;

use Illuminate\Support\Carbon;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\PlanId;
use Highwayns\ShopifyAdmin\Objects\Enums\ChargeStatus;
use Highwayns\ShopifyAdmin\Objects\Enums\ChargeType;
use Highwayns\ShopifyAdmin\Objects\Values\ChargeReference;
use Highwayns\ShopifyAdmin\Objects\Values\ShopId;

/**
 * Reprecents create charge.
 */
final class Charge extends AbstractTransfer
{
    /**
     * Shop ID.
     *
     * @var ShopId
     */
    public $shopId;

     /**
      * Plan ID.
      *
      * @var PlanId
      */
    public $planId;

    /**
     * Charge ID from Shopify.
     *
     * @var ChargeReference
     */
    public $chargeReference;

    /**
     * Charge type (recurring or single).
     *
     * @var ChargeType
     */
    public $chargeType;

    /**
     * Charge status.
     *
     * @var ChargeStatus $chargeStatus
     */
    public $chargeStatus;

    /**
     * When the charge was activated.
     *
     * @var Carbon
     */
    public $activatedOn;

    /**
     * When the charge will be billed on.
     *
     * @var Carbon|null
     */
    public $billingOn;

    /**
     * When the trial ends on.
     *
     * @var Carbon|null
     */
    public $trialEndsOn;

    /**
     * Plan details for reference.
     *
     * @var PlanDetails
     */
    public $planDetails;
}
