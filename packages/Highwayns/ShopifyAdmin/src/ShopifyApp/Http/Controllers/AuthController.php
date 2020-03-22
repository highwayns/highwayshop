<?php

namespace Highwayns\ShopifyAdmin\Http\Controllers;

use Illuminate\Routing\Controller;
use Highwayns\ShopifyAdmin\Traits\AuthController as AuthControllerTrait;

/**
 * Responsible for authenticating the shop.
 */
class AuthController extends Controller
{
    use AuthControllerTrait;
}
