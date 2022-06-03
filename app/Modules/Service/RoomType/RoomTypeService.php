<?php

namespace App\Modules\Service\RoomType;

use App\Modules\Models\RoomType\RoomType;

use App\Modules\Service\Service;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class RoomTypeService extends Service
{
    protected $roomtype;

    public function __construct(Roomtype $roomtype)
    {
        $this->roomtype = $roomtype;
    }

    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->roomtype->orderBy('id','DESC')->paginate($filter['limit']);
    }

    public function getBySlug($id){
        return $this->roomtype->whereId($id)->first();
    }


    public function getAllData()
    {
        $query = $this->roomtype->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editcolumn('actions', function (roomtype $roomtype) {
                $editRoute =  route('room.edit', $roomtype->id);
                $deleteRoute =  route('room.destroy', $roomtype->id);
                return getTableHtml($roomtype, 'actions', $editRoute, $deleteRoute);
            })
            ->rawColumns(['actions', 'status_change'])->make(true);
    }

    public function create(array $data)
    {
        try {

            $data['created_by']= Auth::user()->id;
            // dd($data);
            $roomtype = $this->roomtype->create($data);
            return $roomtype;

        } catch (Exception $e) {
            return null;
        }
    }

    public function find($roomtypeId)
    {
        try {
            return $this->roomtype->whereIsDeleted('no')->find($roomtypeId);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($roomtypeId, array $data)
    {
        try {

            $roomtype= $this->roomtype->find($roomtypeId);
            $data['updated_by']= Auth::user()->id;

            $roomtype = $roomtype->update($data);
            //$this->logger->info(' created successfully', $data);

            return $roomtype;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public function delete($roomtypeId)
    {
        try {
            $roomtype = $this->roomtype->find($roomtypeId);
            return $roomtype = $roomtype->delete();

        } catch (Exception $e) {
            return false;
        }
    }

}
