<?php

namespace App\Modules\Models\CheckIn;

use App\Modules\Models\Bill\Bill;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\RoomType\RoomType;
use App\Modules\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'checked_in',
        'checked_out',
        'room_no',
        'room_id',
        'total_no_people',
        'total_no_rooms',
        'initial_payment',
        'expected_days',
        'created_by',
        'updated_by',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function roomtype()
    {
        return $this->belongsTo(RoomType::class,'room_id','id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class,'checkin_id','id')->orderBy('date');
    }
}
