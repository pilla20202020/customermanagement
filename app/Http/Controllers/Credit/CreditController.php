<?php

namespace App\Http\Controllers\Credit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\CreditRequest;
use App\Modules\Models\Credit\Credit;
use App\Modules\Service\Credit\CreditService;
use App\Modules\Service\Customer\CustomerService;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    protected $credit, $customers;

    function __construct(CreditService $credit, CustomerService $customers)
    {
        $this->credit = $credit;
        $this->customers = $customers;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $credit = $this->credit->paginate();
        return view('credit.index', compact('credit'));
    }

    public function getAllData()
    {
        return $this->credit->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = $this->customers->paginate();
        return view('credit.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreditRequest $request)
    {
        //
        if($credit = $this->credit->create($request->all())){
            Toastr()->success('Credit been created successfully','Success');
            return redirect()->route('credit.index');
        }
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
        $credit = $this->credit->getBySlug($id);
        $customers = $this->customers->paginate();
        return view('credit.edit', compact('credit','customers'));
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
        $input = $request->all();
        $credit = $this->credit->update($id, $input);
        return redirect()->route('credit.index');
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
        if($this->credit->delete($id)) {
            return redirect()->route('credit.index');
        }
    }
}
