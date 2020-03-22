<?php

namespace Highwayns\ShopifyAdmin\Http\Controllers;

use Illuminate\Routing\Controller;
use Highwayns\ShopifyAdmin\Traits\WebhookController as WebhookControllerTrait;

/**
 * Responsible for handling incoming webhook requests.
 */
class WebhookController extends Controller
{
    use WebhookControllerTrait;
}
