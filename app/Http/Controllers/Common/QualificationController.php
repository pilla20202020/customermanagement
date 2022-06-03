<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Modules\Models\Qualification\Qualification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QualificationController extends Controller
{
    public function index()
    {
        return view('qualification.index');
    }

    public function getAllData()
    {
        $query = Qualification::all();
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
                $editRoute =  route('qualification.edit', $query->id);
                // $deleteRoute =  route('user.destroy', $query->id);
                return getTableHtml($query, 'actions', $editRoute);
            })->rawColumns(['status'])->make(true);
    }

    public function create()
    {
        return view('qualification.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'qualification' => 'required|max:255|unique:qualifications',
            'description' => 'max:1024'
        ]);
        if (Qualification::create($request->all())) {
            return redirect()->route('qualification.index')->with('message', 'The Qualification Created Successfully!');
        }else{
            return redirect()->route('qualification.index')->with('error', 'Some Error Occured!');
        }
    }

    public function edit($Qualification_id)
    {
        try{
            $qualification = Qualification::findOrFail($Qualification_id);
            return view('qualification.edit',compact('qualification'));
        }catch(ModelNotFoundException $ex){
            return redirect()->route('qualification.index')->with('error', $ex->getMessage());
        }
    }

    public function update(Request $request, $qualification_id)
    {
        $request->validate([
            'qualification' => 'required|max:255',
            'description' => 'max:1024'
        ]);

        try{
            $qualification = Qualification::findOrFail($qualification_id);
            $qualification->update($request->all());
            return redirect()->route('qualification.index')->with('message', 'The Job Type Updated Successfully!');
        }catch(ModelNotFoundException $ex){
            return redirect()->route('qualification.index')->with('error', $ex->getMessage());
        }
    }

    public function getQualifications()
    {
        $qualifications = Qualification::all();
        return response()->json(['message'=>$qualifications]);
    }
}
