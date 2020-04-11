<?php

namespace Highwayns\Vendor\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Highwayns\Vendor\Repositories\VendorSourceRepository;
use Highwayns\Vendor\Repositories\VendorRoleRepository;
use Highwayns\Vendor\Http\Requests\VendorForm;
use Hash;

/**
 * Admin user controller
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class VendorSourceController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * vendorSourceRepository object
     *
     * @var Object
     */
    protected $vendorSourceRepository;

    /**
     * RoleRepository object
     *
     * @var Object
     */
    protected $vendorRoleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Highwayns\Agent\Repositories\vendorSourceRepository $vendorSourceRepository
     * @param  \Highwayns\Agent\Repositories\RoleRepository $roleRepository
     * @return void
     */
    public function __construct(
        VendorSourceRepository $vendorSourceRepository,
        VendorRoleRepository $vendorRoleRepository
    )
    {
        $this->vendorSourceRepository = $vendorSourceRepository;

        $this->vendorRoleRepository = $vendorRoleRepository;

        $this->_config = request('_config');

        $this->middleware('guest', ['except' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View 
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View 
     */
    public function create()
    {
        $roles = $this->vendorRoleRepository->all();

        return view($this->_config['view'], compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Highwayns\Vendor\Http\Requests\VendorForm  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VendorForm $request)
    {
        $data = $request->all();

        if (isset($data['password']) && $data['password'])
            $data['password'] = bcrypt($data['password']);

        Event::fire('vendor.vendor_source.create.before');

        $vendorSource = $this->vendorSourceRepository->create($data);

        Event::fire('vendor.vendor_source.create.after', $vendorSource);
    
        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'User']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id
     * @return \Illuminate\View\View 
     */
    public function edit($id)
    {
        $user = $this->vendorSourceRepository->findOrFail($id);

        $roles = $this->vendorRoleRepository->all();

        return view($this->_config['view'], compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Highwayns\Vendor\Http\Requests\VendorForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VendorForm $request, $id)
    {
        $data = $request->all();

        if (! $data['password'])
            unset($data['password']);
        else
            $data['password'] = bcrypt($data['password']);

        if (isset($data['status'])) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        Event::fire('vendor.vendor_source.update.before', $id);

        $vendorSource = $this->vendorSourceRepository->update($data, $id);

        Event::fire('vendor.vendor_source.update.after', $vendorSource);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'User']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View 
     */
    public function destroy($id)
    {
        $user = $this->vendorSourceRepository->findOrFail($id);

        if ($this->vendorSourceRepository->count() == 1) {
            session()->flash('error', trans('admin::app.settings.vendor_sources.last-delete-error', ['name' => 'Vendor']));
        } else {
            Event::fire('vendor.vendor_source.delete.before', $id);

            try {
                $this->vendorSourceRepository->delete($id);

                session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Vendor']));

                Event::fire('vendor.vendor_source.delete.after', $id);

                return response()->json(['message' => true], 200);
            } catch (Exception $e) {
                session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Vendor']));
            }
        }

        return response()->json(['message' => false], 400);
    }

}
