<?php

namespace Webkul\VendorAdmin\Http\Controllers\Development;

use Webkul\VendorAdmin\Http\Controllers\Controller;

/**
 * Dashboard controller
 *
 * @author    Alexey Khachatryan <info@khachatryan.org>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
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