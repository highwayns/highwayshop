<?php

namespace Highwayns\VendorAdmin\Http\Controllers\Development;

use Highwayns\VendorAdmin\Http\Controllers\Controller;

/**
 * Dashboard controller
 *
 * @author    Alexey Khachatryan <info@khachatryan.org>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::settings.development.dashboard');
    }
}