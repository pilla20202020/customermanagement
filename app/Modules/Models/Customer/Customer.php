<?php

namespace App\Modules\Models\Customer;

use App\Modules\Models\CheckIn\CheckIn;
use App\Modules\Models\District\District;
use App\Modules\Models\Municipality\Municipality;
use App\Modules\Models\Province\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $path ='uploads/customers';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'dob',
        'gender',
        'blood_group',
        'marital_status',
        'identification_no',
        'identification_type',
        'citizenship_issue_date',
        'citizenship_issue_district_id',
        'spouse_name',
        'father_name',
        'mother_name',
        'mobile_no',
        'alternate_mobile_no',
        'country_id',
        'province_id',
        'district_id',
        'municipality_id',
        'ward_no',
        'village_name',
        'full_address',
        'image',
        'citizenship_image',
        'status',
        'created_by',
        'updated_by',
    ];

    function getImagePathAttribute(){
        return $this->path.'/image/'. $this->image;
    }

    function getCitizenPathAttribute(){
        return $this->path.'/citizenship/'. $this->citizenship_image;
    }

    public function customer_province(){
        return $this->belongsTo(Province::class,'province_id','id');
    }

    public function customer_district(){
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function customer_municipality(){
        return $this->belongsTo(Municipality::class,'municipality_id','id');
    }

    public function checkin(){
        return $this->hasMany(CheckIn::class,'customer_id','id');
    }
}
