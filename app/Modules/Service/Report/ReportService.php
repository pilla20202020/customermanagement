<?php

namespace App\Modules\Service\Report;

use App\Modules\Models\CheckIn\CheckIn;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\RoomType\RoomType;

use App\Modules\Service\Service;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class ReportService extends Service
{
    protected $customer, $checkin;

    public function __construct(Customer $customer, CheckIn $checkin)
    {
        $this->customer = $customer;
        $this->checkin = $checkin;
    }

    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->customer->orderBy('id','DESC')->paginate($filter['limit']);
    }

    public function getBySlug($id){
        return $this->roomtype->whereId($id)->first();
    }


    public function getAllData()
    {
        $query = $this->checkin->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('name', function($query){
                return $query->customer->first_name .' '.$query->customer->middle_name.' '.$query->customer->last_name;
            })
            ->addColumn('total_price', function($query){
                return ($query->bills->sum('total') - $query->initial_payment);
            })
            ->editColumn('actions', function($query){
                $viewRoute = route('checkin.show', $query->id);
                return getTableHtml($query, 'actions',$editRoute=null, $deleteRoute=null, $printRoute=null, $viewRoute);
            })
            ->rawColumns(['actions', 'status_change'])->make(true);
    }

    public function getReportsByParameter($request){
        $filters = [
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
        ];
        $checkin = $this->checkin->where(function ($query) use($filters) {
            if ($filters['from_date'] || $filters['to_date']) {
                $query->whereBetween('checked_out', [ $filters['from_date'],  $filters['to_date']])->whereBetween('checked_out', [ $filters['from_date'],  $filters['to_date']]);
            }
        })->latest()->get();
        return $checkin;
    }

}
