<?php

namespace App\Http\Controllers\RoomType;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\RoomTypeRequest;
use App\Modules\Service\RoomType\RoomTypeService;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    protected $roomtype;

    function __construct(RoomTypeService $roomtype)
    {
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
        $roomtype = $this->roomtype->paginate();
        return view('roomtype.index', compact('roomtype'));
    }

    public function getAllData()
    {
        return $this->roomtype->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roomtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomTypeRequest $request)
    {
        if($roomtype = $this->roomtype->create($request->all())){
            Toastr()->success('Room Type has been created successfully','Success');
            return redirect()->route('room.index');
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
        $roomtype = $this->roomtype->getBySlug($id);
        return view('roomtype.edit', compact('roomtype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomTypeRequest $request, $id)
    {
        //
        $input = $request->all();
        $roomtype = $this->roomtype->update($id, $input);
        return redirect()->route('room.index');
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
        if($this->roomtype->delete($id)) {
            return redirect()->route('room.index');
        }
    }
}
