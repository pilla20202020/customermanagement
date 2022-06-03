<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Modules\Models\Common\JobType;
use App\Modules\Models\Category\JobCategory;
use App\Modules\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class JobTypeController extends Controller
{
    public function index()
    {   
        return view('jobtype.index');
    }

    public function getAllData()
    {
        $query = JobType::orderBy('created_at','DESC')->get();

        return DataTables::of($query)

            ->addIndexColumn()
            ->editColumn('category_id',function($query){
                return $query->category->category_name;
            })
            ->editColumn('status', function ($query) {
                if ($query->status == 'Active') {
                    return '<span class="badge badge-info">Active</span>';
                } else {
                    return '<span class="badge badge-danger">In-Active</span>';
                }
            })
            ->addColumn('actions', function ($query) {
                $editRoute =  route('jobtype.edit', $query->id);
                // $deleteRoute =  route('user.destroy', $query->id);
                return getTableHtml($query, 'actions', $editRoute);
            })->rawColumns(['status'])->make(true);
    }

    public function create()
    {   
        $job_categories = JobCategory::where('status','Active')->get();
        return view('jobtype.create',compact('job_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_type' => 'required|max:255|unique:job_types',
            'description' => 'max:1024',
        ]);
        $created_by = Auth::user()->id;
        $updated_by = Auth::user()->id;
        $input = [
            'job_type' => $request->job_type,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => $created_by,
            'updated_by' => $updated_by
        ];
        // dd($input);
        if (JobType::create($input)) {
            Toastr()->success('Job type has been added successfully','Success');
            return redirect()->route('jobtype.index');
        }else{
            return redirect()->route('jobtype.index')->with('error', 'Some Error Occured!');
        }
    }

    public function edit($jobtype_id)
    {
        try{
            $job_categories = JobCategory::where('status','Active')->get();
            $jobtype = JobType::findOrFail($jobtype_id);
            return view('jobtype.edit',compact('jobtype','job_categories'));
        }catch(ModelNotFoundException $ex){
            return redirect()->route('jobtype.index')->with('error', $ex->getMessage());
        }
    }

    public function update(Request $request, $jobtype_id)
    {   
        try{
            $jobtype = JobType::findOrFail($jobtype_id);
            $jobtype->category_id = $request->category_id;
            $jobtype->job_type = $request->job_type;
            $jobtype->description = $request->description;
            $jobtype->status = $request->status;
            $jobtype->updated_by = Auth::user()->id;
            $jobtype->save();
            Toastr()->success('Job type has been updated successfully','Success');
            return redirect()->route('jobtype.index');
        }catch(ModelNotFoundException $ex){
            return redirect()->route('jobtype.index')->with('error', $ex->getMessage());
        }
    }
}
