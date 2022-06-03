<?php

namespace App\Http\Controllers\CheckIn;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckIn\CheckInRequest;
use App\Modules\Models\Bill\Bill;
use App\Modules\Models\CheckIn\CheckIn;
use App\Modules\Models\Customer\Customer;
use App\Modules\Service\CheckIn\CheckInService;
use App\Modules\Service\Customer\CustomerService;
use App\Modules\Service\RoomType\RoomTypeService;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    protected $checkIn,$customer,$roomtype;

    function __construct(CheckInService $checkIn, CustomerService $customer, RoomTypeService $roomtype)
    {
        $this->checkIn = $checkIn;
        $this->customer = $customer;
        $this->roomtype = $roomtype;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $checkIn = $this->checkIn->paginate();
        return view('checkin.index', compact('checkIn'));
    }

    public function getAllData()
    {
        return $this->checkIn->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = $this->customer->paginate();
        $roomtypes = $this->roomtype->paginate();
        return view('checkin.create', compact('customers','roomtypes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckInRequest $request)
    {
        //
        $checkin_valid = $this->checkIn->checkInRequest($request);

        if($checkin_valid == true){
            if($checkIn = $this->checkIn->create($request->all())){
                Toastr()->success('Check-In has been created successfully','Success');
                return redirect()->route('checkin.index');
            }
        } else {
            return redirect()->back();
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
        $checkin = $this->checkIn->find($id);
        $total_bill_price = $checkin->bills->sum('total');
        $total_price = $total_bill_price - $checkin->initial_payment;
        return view('checkin.show', compact('checkin','total_bill_price','total_price'));
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
        $checkin = $this->checkIn->find($id);
        $customers = $this->customer->paginate();
        $roomtypes = $this->roomtype->paginate();
        return view('checkin.edit', compact('checkin','customers','roomtypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckInRequest $request, $id)
    {
        //
        $input = $request->all();
        $checkIn = $this->checkIn->update($id, $input);
        return redirect()->route('checkin.index');
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

    public function getRoomTypePrice(Request $request)
    {
        $room_id = $request->room_id;
        $roomtype = $this->roomtype->getBySlug($room_id);
        return response()->json(['message'=>$roomtype]);
    }

    public function addCheckOut(Request $request) {
        $checkin = $this->checkIn->verifyCheckOutDate($request);
        if($checkin == true){
            $checkin = $this->checkIn->addCheckOutDate($request);
            Toastr()->success('Check Out has been added successfully','Success');
            return redirect()->route('checkin.index');
        } else {
            return redirect()->back();
        }
    }

    public function generateBill($id) {
        $checkin = $this->checkIn->find($id);
        return view('checkin.showbill', compact('checkin'));

    }

    public function storeGenerateBill(Request $request) {
        $addbill = $this->checkIn->createBill($request);
        Toastr()->success('Bill has been added successfully','Success');
        return redirect()->route('checkin.index');

    }


    public function deleteBill($id) {

        if($this->checkIn->deleteBill($id)) {
            Toastr()->success('Bill has been deleted successfully','Success');
            return redirect()->back();
        }
        else {
            Toastr()->success('Bill cannot be deleted at the moment','Error');
            return redirect()->back();
        }

    }

    public function generateInvoice($id) {
        $checkin = $this->checkIn->find($id);
        $total_bill_price = $checkin->bills->sum('total');
        $total_price = $total_bill_price - $checkin->initial_payment;
        return view('checkin.invoice', compact('checkin','total_bill_price','total_price'));

    }

    public function publishInvoice(Request $request) {
        if($checkin = $this->checkIn->updateInvoice($request)) {
            $response = [
                'alert-type' => 'success',
                'message' => 'Invoice has been Generated successfully',
            ];
            return response()->json($response);
        }
    }
}
