<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Modules\Models\Common\SchoolUniversity;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SchoolUniversityController extends Controller
{
    public function index()
    {
        return view('sc.index');
    }

    public function getAllData()
    {
        $query = SchoolUniversity::all();
        return DataTables::of($query)

            ->addIndexColumn()
            ->editColumn('status', function ($query) {
                if ($query->status == 'Active') {
                    return '<span class="badge badge-info">Active</span>';
                } else {
                    return '<span class="badge badge-danger">In-Active</span>';
                }
            })
            ->addColumn('actions', function ($query) {
                $editRoute =  route('sc.edit', $query->id);
                // $deleteRoute =  route('user.destroy', $query->id);
                return getTableHtml($query, 'actions', $editRoute);
            })->rawColumns(['status'])->make(true);
    }

    public function create()
    {
        return view('sc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            's_u_name' => 'required|max:255|unique:school_universities',
            'address' => 'max:255',
            'description' => 'max:1024'
        ]);
        if (SchoolUniversity::create($request->all())) {
            return redirect()->route('sc.index')->with('message', 'The School University Created Successfully!');
        }else{
            return redirect()->route('sc.index')->with('error', 'Some Error Occured!');
        }
    }

    public function edit($sc_id)
    {
        try{
            $sc = SchoolUniversity::findOrFail($sc_id);
            return view('sc.edit',compact('sc'));
        }catch(ModelNotFoundException $ex){
            return redirect()->route('sc.index')->with('error', $ex->getMessage());
        }
    }

    public function update(Request $request, $sc_id)
    {
        $request->validate([
            's_u_name' => 'required|max:255',
            'address' => 'max:255',
            'description' => 'max:1024'
        ]);

        try{
            $sc = SchoolUniversity::findOrFail($sc_id);
            $sc->update($request->all());
            return redirect()->route('sc.index')->with('message', 'The School University Updated Successfully!');
        }catch(ModelNotFoundException $ex){
            return redirect()->route('sc.index')->with('error', $ex->getMessage());
        }
    }
}
