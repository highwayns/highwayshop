<?php

namespace Webkul\Agent\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Webkul\Agent\Repositories\AgentSourceRepository;
use Webkul\Vendor\Repositories\VendorSourceRepository;
use Webkul\Agent\Repositories\AgentRoleRepository;
use Webkul\Agent\Http\Requests\AgentForm;
use Hash;

/**
 * Admin user controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class AgentSourceController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * agentSourceRepository object
     *
     * @var Object
     */
    protected $agentSourceRepository;

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
    protected $agentRoleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\User\Repositories\agentSourceRepository $agentSourceRepository
     * @param  \Webkul\User\Repositories\RoleRepository $roleRepository
     * @return void
     */
    public function __construct(
        AgentSourceRepository $agentSourceRepository,
        AgentRoleRepository $agentRoleRepository,
        VendorSourceRepository $vendorSourceRepository
    )
    {
        $this->agentSourceRepository = $agentSourceRepository;

        $this->agentRoleRepository = $agentRoleRepository;

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
        $roles = $this->agentRoleRepository->all();

        $vendors = $this->vendorSourceRepository->all();

        return view($this->_config['view'], compact('roles', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Webkul\Agent\Http\Requests\AgentForm  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AgentForm $request)
    {
        $data = $request->all();

        if (isset($data['password']) && $data['password'])
            $data['password'] = bcrypt($data['password']);

        Event::fire('agent.agent_source.create.before');

        $agentSource = $this->agentSourceRepository->create($data);

        Event::fire('agent.agent_source.create.after', $agentSource);
    
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
        $user = $this->agentSourceRepository->findOrFail($id);

        $roles = $this->agentRoleRepository->all();

        $vendors = $this->vendorSourceRepository->all();

        return view($this->_config['view'], compact('user', 'roles', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Webkul\Agent\Http\Requests\AgentForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgentForm $request, $id)
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

        Event::fire('agent.agent_source.update.before', $id);

        $agentSource = $this->agentSourceRepository->update($data, $id);

        Event::fire('agent.agent_source.update.after', $agentSource);

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
        $user = $this->agentSourceRepository->findOrFail($id);

        if ($this->agentSourceRepository->count() == 1) {
            session()->flash('error', trans('admin::app.settings.agent_sources.last-delete-error', ['name' => 'Agent']));
        } else {
            Event::fire('agent.agent_source.delete.before', $id);

            try {
                $this->agentSourceRepository->delete($id);

                session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Agent']));

                Event::fire('agent.agent_source.delete.after', $id);

                return response()->json(['message' => true], 200);
            } catch (Exception $e) {
                session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Agent']));
            }
        }

        return response()->json(['message' => false], 400);
    }

}
