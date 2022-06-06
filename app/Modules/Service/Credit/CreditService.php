<?php

namespace App\Modules\Service\Credit;

use App\Modules\Models\Credit\Credit;

use App\Modules\Service\Service;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class CreditService extends Service
{
    protected $credit;

    public function __construct(Credit $credit)
    {
        $this->credit = $credit;
    }

    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->credit->orderBy('id','DESC')->paginate($filter['limit']);
    }

    public function getBySlug($id){
        return $this->credit->whereId($id)->first();
    }


    public function getAllData()
    {
        $query = $this->credit->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('customer_id', function($query){
                return $query->customer->first_name.' '.$query->customer->middle_name.' '.$query->customer->last_name;
            })
            ->editcolumn('actions', function (Credit $credit) {
                $editRoute =  route('credit.edit', $credit->id);
                $deleteRoute =  route('credit.destroy', $credit->id);
                return getTableHtml($credit, 'actions', $editRoute, $deleteRoute);
            })
            ->rawColumns(['actions', 'status_change'])->make(true);
    }

    public function create(array $data)
    {
        try {
            $previous_record = $this->credit->where('customer_id',$data['customer_id'])->first();
            if(isset($previous_record)) {
                $data['updated_by']= Auth::user()->id;
                $data['price'] = $previous_record->price + $data['price'];
                $credit = $previous_record->update($data);

            } else {
                $data['created_by']= Auth::user()->id;
                $credit = $this->credit->create($data);
            }
            // dd($data);
            return $credit;

        } catch (Exception $e) {
            return null;
        }
    }

    public function find($creditId)
    {
        try {
            return $this->credit->whereIsDeleted('no')->find($creditId);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($creditId, array $data)
    {
        try {

            $credit= $this->credit->find($creditId);
            $data['updated_by']= Auth::user()->id;

            $credit = $credit->update($data);
            //$this->logger->info(' created successfully', $data);

            return $credit;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public function delete($creditId)
    {
        try {
            $credit = $this->credit->find($creditId);
            return $credit = $credit->delete();

        } catch (Exception $e) {
            return false;
        }
    }

}
