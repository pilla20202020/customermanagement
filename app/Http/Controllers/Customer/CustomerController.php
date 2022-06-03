<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Modules\Models\District\District;
use App\Modules\Models\Municipality\Municipality;
use App\Modules\Models\Province\Province;
use App\Modules\Service\Customer\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected $customer;

    function __construct(CustomerService $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = $this->customer->paginate();
        return view('customer.index', compact('customer'));
    }

    public function getAllData()
    {
        return $this->customer->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = getProvinces();
        $districts = getDistricts();
        return view('customer.create', compact('provinces','districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        //
        $customer = $this->customer->create($request->all());
        Toastr()->success('Customer has been created successfully','Success');
        return redirect()->route('customer.index');
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
        $customer = $this->customer->find($id);
        return view('customer.show', compact('customer'));
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
        $customer = $this->customer->getById($id);
        $provinces = getProvinces();
        $countries = getCountries();
        $districts = getDistricts();
        return view('customer.edit', compact('customer', 'countries', 'districts','provinces',));

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
        $customer = $this->customer->find($id);
        $input = $request->all();
        $customer = $this->customer->update($id, $input);

        Toastr()->success('Customer data has been updated successfully','Success');
        return redirect()->route('customer.index');
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
        $customer = $this->customer->delete($id);
        {
            return redirect()->route('customer.index');
        }
    }

    public function getPermanentProvince(Request $request)
    {
        $country_id = $request->perm_country_id;
        $province_id = Province::where('country_id', $country_id)->get();
        return response()->json(['message'=>$province_id]);
    }

    public function getPermanentDistrict(Request $request)
    {
        $province_id = $request->perm_province_id;
        $district_id = District::where('province_id',$province_id)->get();
        return response()->json(['message'=>$district_id]);
    }

    public function getPermanentMunicipality(Request $request)
    {
        $district_id = $request->perm_district_id;
        $municipality_id = Municipality::where('district_id',$district_id)->get();
        return response()->json(['message'=>$municipality_id]);
    }
}
