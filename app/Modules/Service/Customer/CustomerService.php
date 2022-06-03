<?php

namespace App\Modules\Service\Customer;

use App\Modules\Models\Customer\Customer;
use Yajra\DataTables\Facades\DataTables;
use App\Modules\Service\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerService extends Service
{

    protected $customer;

    public function __construct( Customer $customer)
    {
        $this->customer = $customer;
    }


    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->customer->orderBy('id','DESC')->paginate($filter['limit']);
    }

    public function getAllData()
    {
        $query = $this->customer->where('is_deleted','no')->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('name', function($query){
                return $query->first_name .' '.$query->middle_name.' '.$query->last_name;
            })
            ->editColumn('actions', function($query){
                $viewRoute = route('customer.show', $query->id);
                $editRoute = route('customer.edit', $query->id);
                $deleteRoute = route('customer.delete', $query->id);
                return getTableHtml($query, 'actions',$editRoute, $deleteRoute, $printRoute=null, $viewRoute);
            })
            ->rawColumns(['actions'])->make(true);
    }

    public function create(array $data)
    {
        try {
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $customer = DB::transaction(function () use ($data) {
                $customerData = [
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'gender' => $data['gender'],
                    'marital_status' => $data['marital_status'] ?? null,
                    'father_name' => $data['father_name'],
                    'mother_name' => $data['mother_name'],
                    'spouse_name' => $data['spouse_name'] ?? null,
                    'mobile_no' => $data['mobile_no'],
                    'alternate_mobile_no' => $data['alternate_mobile_no'],
                    'province_id' => $data['province_id'] ?? null,
                    'district_id' => $data['district_id'] ?? null,
                    'municipality_id' => $data['municipality_id'] ?? null,
                    'ward_no' => $data['ward_no'],
                    'village_name' => $data['village_name'],
                    'nationality' => $data['nationality'],
                    'citizenship' => $data['citizenship'],
                    'citizenship_issue_district_id' => $data['citizenship_issue_district_id'],
                    'status' => 'Pending',
                    'created_by' => Auth::user()->id
                ];

                // if (!empty($data['image'])) {
                //     $staffPhotoPath = uploadCommonFile($data['image'], 'image/');
                //     $customerData['image'] = $staffPhotoPath;
                // }

                if (!empty($data['image'])) {
                    $dir = public_path().'/uploads/customers/image/';
                    $image_name = resizeAndUploadImage($data['image'], $dir, $quality=200, $thumb="400" );
                    $customerData['image'] = $image_name;
                }

                if (!empty($data['citizenship_image'])) {
                    $dir = public_path().'/uploads/customers/citizenship/';
                    $citizenship = resizeAndUploadImage($data['citizenship_image'], $dir, $quality=200, $thumb="400" );
                    $customerData['citizenship_image'] = $citizenship;
                }

                $customer = $this->customer->create($customerData);

                return $customer;
            });
            return $customer;
        } catch (Exception $e) {
            return null;
        }
    }

    public function getById($id)
    {
        return $this->customer->where('id', $id)->first();
    }

    public function find($customerId)
    {
        try {
            return $this->customer->find($customerId);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($customerId, array $data)
    {
        try{
            $customer = DB::transaction(function() use ($customerId, $data){
                $data['updated_by'] = Auth::user()->id;
                $customer = $this->customer->find($customerId);
                $customerData = [
                    // 'user_id' => $user->id,
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'gender' => $data['gender'],
                    'marital_status' => $data['marital_status'] ?? null,
                    'father_name' => $data['father_name'],
                    'mother_name' => $data['mother_name'],
                    'spouse_name' => $data['spouse_name'] ?? null,
                    'mobile_no' => $data['mobile_no'],
                    'alternate_mobile_no' => $data['alternate_mobile_no'],
                    'country_id' => $data['country_id'] ?? null,
                    'province_id' => $data['province_id'] ?? null,
                    'district_id' => $data['district_id'] ?? null,
                    'municipality_id' => $data['municipality_id'] ?? null,
                    'ward_no' => $data['ward_no'],
                    'village_name' => $data['village_name'],
                    'nationality' => $data['nationality'],
                    'citizenship' => $data['citizenship'],
                    'citizenship_issue_district_id' => $data['citizenship_issue_district_id'],
                ];

                if (!empty($data['image'])) {
                    $dir = public_path().'/uploads/customers/image/';
                    $image_name = resizeAndUploadImage($data['image'], $dir, $quality=200, $thumb="400" );
                    $customerData['image'] = $image_name;
                }

                if (!empty($data['citizenship_image'])) {
                    $dir = public_path().'/uploads/customers/citizenship/';
                    $citizenship = resizeAndUploadImage($data['citizenship_image'], $dir, $quality=200, $thumb="400" );
                    $customerData['citizenship_image'] = $citizenship;
                }

                $customer->update($customerData);
            });
        }  catch (Exception $e) {
            return null;
        }
    }

    public function delete($customerId)
    {
        try{
            $customer = $this->customer->find($customerId);
            $customer->is_deleted = "yes";
            $customer->deleted_by = Auth::user()->id;
            $customer->save();
        } catch(Exception $e) {
            return null;
        }
    }


}
