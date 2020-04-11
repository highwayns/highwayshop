<?php

namespace Highwayns\Merchant\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Highwayns\Merchant\Repositories\MerchantSourceRepository;
use Highwayns\Vendor\Repositories\VendorSourceRepository;
use Highwayns\Merchant\Repositories\MerchantRoleRepository;
use Highwayns\Merchant\Http\Requests\MerchantForm;
use Hash;

/**
 * Admin user controller
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class MerchantSourceController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * merchantSourceRepository object
     *
     * @var Object
     */
    protected $merchantSourceRepository;

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
    protected $merchantRoleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Highwayns\Agent\Repositories\merchantSourceRepository $merchantSourceRepository
     * @param  \Highwayns\Agent\Repositories\RoleRepository $roleRepository
     * @return void
     */
    public function __construct(
        MerchantSourceRepository $merchantSourceRepository,
        MerchantRoleRepository $merchantRoleRepository,
        VendorSourceRepository $vendorSourceRepository
    )
    {
        $this->merchantSourceRepository = $merchantSourceRepository;

        $this->merchantRoleRepository = $merchantRoleRepository;

        $this->vendorSourceRepository = $vendorSourceRepository;

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
        $roles = $this->merchantRoleRepository->all();

        $vendors = $this->vendorSourceRepository->all();

        return view($this->_config['view'], compact('roles', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Highwayns\Merchant\Http\Requests\MerchantForm  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MerchantForm $request)
    {
        $data = $request->all();

        if (isset($data['password']) && $data['password'])
            $data['password'] = bcrypt($data['password']);

        Event::fire('merchant.merchant_source.create.before');

        $merchantSource = $this->merchantSourceRepository->create($data);

        Event::fire('merchant.merchant_source.create.after', $merchantSource);
    
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
        $user = $this->merchantSourceRepository->findOrFail($id);

        $roles = $this->merchantRoleRepository->all();

        $vendors = $this->vendorSourceRepository->all();

        return view($this->_config['view'], compact('user', 'roles', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Highwayns\Merchant\Http\Requests\MerchantForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MerchantForm $request, $id)
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

        Event::fire('merchant.merchant_source.update.before', $id);

        $merchantSource = $this->merchantSourceRepository->update($data, $id);

        Event::fire('merchant.merchant_source.update.after', $merchantSource);

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
        $user = $this->merchantSourceRepository->findOrFail($id);

        if ($this->merchantSourceRepository->count() == 1) {
            session()->flash('error', trans('admin::app.settings.merchant_sources.last-delete-error', ['name' => 'Merchant']));
        } else {
            Event::fire('merchant.merchant_source.delete.before', $id);

            try {
                $this->merchantSourceRepository->delete($id);

                session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Merchant']));

                Event::fire('merchant.merchant_source.delete.after', $id);

                return response()->json(['message' => true], 200);
            } catch (Exception $e) {
                session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Merchant']));
            }
        }

        return response()->json(['message' => false], 400);
    }

}
