<?php

namespace Highwayns\Agent\Http\Controllers;

use Auth;

/**
 * Admin user session controller
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
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
        $this->middleware('agentadmin')->except(['create','store']);

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
        if (auth()->guard('agentadmin')->check()) {
            return redirect()->route('agentadmin.dashboard.index');
        } else {
            if (strpos(url()->previous(), 'agentadmin') !== false) {
                $intendedUrl = url()->previous();
            } else {
                $intendedUrl = route('agentadmin.dashboard.index');
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

        if (! auth()->guard('agentadmin')->attempt(request(['email', 'password']), $remember)) {
            session()->flash('error', trans('admin::app.users.users.login-error'));

            return redirect()->back();
        }

        if (auth()->guard('agentadmin')->user()->status == 0) {
            session()->flash('warning', trans('admin::app.users.users.activate-warning'));

            auth()->guard('agentadmin')->logout();

            return redirect()->route('agentadmin.session.create');
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
        auth()->guard('agentadmin')->logout();

        return redirect()->route($this->_config['redirect']);
    }
}