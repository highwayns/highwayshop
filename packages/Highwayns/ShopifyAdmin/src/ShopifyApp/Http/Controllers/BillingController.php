<?php

namespace Highwayns\ShopifyAdmin\Http\Controllers;

use Illuminate\Routing\Controller;
use Highwayns\ShopifyAdmin\Traits\BillingController as BillingControllerTrait;

/**
 * Responsible for billing a shop for plans and usage charges.
 */
class BillingController extends Controller
{
    use BillingControllerTrait;
}
