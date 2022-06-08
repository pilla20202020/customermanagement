<?php

namespace App\Modules\Service\CheckIn;

use App\Modules\Models\Bill\Bill;
use App\Modules\Models\CheckIn\CheckIn;
use Yajra\DataTables\Facades\DataTables;
use App\Modules\Service\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckInService extends Service
{

    protected $checkIn;

    public function __construct(CheckIn $checkIn)
    {
        $this->checkIn = $checkIn;
    }


    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->checkIn->orderBy('id','DESC')->paginate($filter['limit']);
    }

    public function getAllData()
    {
        $query = $this->checkIn->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('customer_id', function($query){
                return $query->customer->first_name.' '.$query->customer->middle_name.' '.$query->customer->last_name;
            })
            ->addColumn('room_id', function($query){
                return $query->roomtype->title;
            })
            ->editColumn('actions', function($query){
                if($query->checked_out == null) {
                    $checklist = $query->id;
                    $editRoute = route('checkin.edit', $query->id);
                    $billRoute = route('checkin.generate_bill', $query->id);
                    $invoiceRoute = null;
                    $viewRoute = null;
                    $deleteRoute = route('checkin.delete', $query->id);
                } elseif($query->invoice_generated == 1) {
                    $checklist = null;
                    $editRoute = null;
                    $billRoute = null;
                    $invoiceRoute = null;
                    $viewRoute = route('checkin.show', $query->id);
                    $deleteRoute = null;
                }else {
                    $checklist = null;
                    $editRoute = null;
                    $billRoute = route('checkin.generate_bill', $query->id);
                    $invoiceRoute = route('checkin.generate_invoice', $query->id);
                    $viewRoute = null;
                    $deleteRoute = route('checkin.delete', $query->id);
                }
                return getTableHtml($query, 'actions',$editRoute, $deleteRoute, $printRoute=null, $viewRoute,$checklist,$billRoute,$invoiceRoute);
            })
            ->rawColumns(['actions'])->make(true);
    }

    public function create(array $data)
    {
        try {
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $data['created_by']= Auth::user()->id;
            $checkIn = $this->checkIn->create($data);
            return $checkIn;
        } catch (Exception $e) {
            return null;
        }
    }

    public function getById($id)
    {
        return $this->checkIn->where('id', $id)->first();
    }

    public function find($checkInId)
    {
        try {
            return $this->checkIn->find($checkInId);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($checkInId, array $data)
    {
        try{
            $checkIn = DB::transaction(function() use ($checkInId, $data){
                $checkIn = $this->checkIn->find($checkInId);
                $data['updated_by'] = Auth::user()->id;
                $checkIn->update($data);
            });
        }  catch (Exception $e) {
            return null;
        }
    }

    public function delete($checkInId)
    {
        try{
            $checkIn = $this->checkIn->find($checkInId);
            return $checkIn = $checkIn->delete();
        } catch(Exception $e) {
            return null;
        }
    }

    public function checkInRequest($request){
        $customer_id = $request->customer_id;
        $already_checkin = $this->checkIn->where('customer_id',$customer_id)->latest()->first();

        if(isset($already_checkin) && ($already_checkin->checked_out == null)) {
            Toastr()->error('The requested customer is already checkedIn.We cannot create checkin of the customer who is already checked in','Sorry');
            return false;
        }

        $previous_checkin_date = $this->checkIn->where('customer_id',$customer_id)->where('checked_in',$request->checked_in)->get();

        if(isset($previous_checkin_date) && $previous_checkin_date->isEmpty() == false) {
            Toastr()->error('The requested customer has already record checkedIn on the requested date.','Sorry');
            return false;
        }

        $previous_checkin_date = $this->checkIn->where('customer_id',$customer_id)->where('checked_in','<',$request->checked_in)->where('checked_out','>',$request->checked_in)->get();
        if(isset($previous_checkin_date) && $previous_checkin_date->isEmpty() == false) {
            Toastr()->error('The requested customer has already record of checkedIn on the requested date.','Sorry');
            return false;
        }
        return true;
    }

    public function addCheckOutDate($request){
        $checkIn_id = $request->checkin_id;
        $checkIn = $this->checkIn->where('id',$checkIn_id)->first();
        $checkIn->checked_out = $request->checked_out;
        $checkIn->save();
    }

    public function verifyCheckOutDate($request){
        $checkIn_id = $request->checkin_id;
        $checkIn = $this->checkIn->where('id',$checkIn_id)->first();
        if($checkIn->checked_in > $request->checked_out) {
            Toastr()->error('The checkedIn Date is greater than CheckOut Date.Please provide correct date.','Sorry');
            return false;
        }
        return true;
    }

    public function createBill($request){
        try{
            $bills = Bill::where('checkin_id', $request->checkin_id)->get();
            foreach ($bills as $bill) {
                $bill->delete();
            }
            $p = 0;
            foreach($request->title as $content) {
                $bills = new Bill();
                $bills['checkin_id'] = $request->checkin_id;
                $bills['title'] = $content;
                $bills['rate'] = $request->rate[$p];
                $bills['quantity'] = $request->quantity[$p];
                $bills['total'] = $request->rate[$p] * $request->quantity[$p];
                $bills['date'] = $request->date[$p];
                $bills['created_by'] = Auth::user()->id;
                $bills->save();
                $p = $p + 1;
            }
        } catch(Exception $e) {
            return null;
        }

    }

    public function deleteBill($billId)
    {
        try {
            $bill = Bill::find($billId);
            return $bill = $bill->delete();

        } catch (Exception $e) {
            return false;
        }
    }

    public function updateInvoice($request){
        $checkIn_id = $request->checkin_id;
        $checkIn = $this->checkIn->where('id',$checkIn_id)->first();
        $checkIn->invoice_generated = 1;
        $checkIn->save();
        return $checkIn;
    }



}
