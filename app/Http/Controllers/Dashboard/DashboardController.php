<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Modules\Models\Candidate\Candidate;
use App\Modules\Service\Candidate\CandidateService;
use App\Modules\Service\Permission\PermissionService;
use App\Modules\Service\role\RoleService;
use App\Modules\Service\User\UserService;
use App\Modules\Models\User;
use App\Modules\Models\Batch\Batch;
use App\Modules\Models\Candidate\SelectedCandidate;
use App\Modules\Models\CheckIn\CheckIn;
use App\Modules\Models\Customer\Customer;
use App\Modules\Service\Customer\CustomerService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user, $role, $permission,$checkin;

    function __construct(CustomerService $customer, UserService $user, CheckIn $checkin)
    {
        $this->customer = $customer;
        $this->user = $user;
        $this->checkin = $checkin;
    }
    public function index()
    {
        $users_count = User::count();
        $customer_count = Customer::count();
        $customers = $this->customer->paginate();
        $checkins = $this->checkin->latest()->take(5)->paginate();
        return view('dashboard.index',compact('users_count','customer_count','customers','checkins'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
