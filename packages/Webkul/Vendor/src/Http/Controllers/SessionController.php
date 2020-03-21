<?php

namespace Webkul\Vendor\Http\Controllers;

use Auth;

/**
 * Admin user session controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class SessionController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('vendoradmin')->except(['create','store']);

        $this->_config = request('_config');

        $this->middleware('guest', ['except' => 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (auth()->guard('vendoradmin')->check()) {
            return redirect()->route('vendoradmin.dashboard.index');
        } else {
            if (strpos(url()->previous(), 'vendoradmin') !== false) {
                $intendedUrl = url()->previous();
            } else {
                $intendedUrl = route('vendoradmin.dashboard.index');
            }

            session()->put('url.intended', $intendedUrl);

            return view($this->_config['view']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = request('remember');

        if (! auth()->guard('vendoradmin')->attempt(request(['email', 'password']), $remember)) {
            session()->flash('error', trans('admin::app.users.users.login-error'));

            return redirect()->back();
        }

        if (auth()->guard('vendoradmin')->user()->status == 0) {
            session()->flash('warning', trans('admin::app.users.users.activate-warning'));

            auth()->guard('vendoradmin')->logout();

            return redirect()->route('vendoradmin.session.create');
        }

        return redirect()->intended(route($this->_config['redirect']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->guard('vendoradmin')->logout();

        return redirect()->route($this->_config['redirect']);
    }
}