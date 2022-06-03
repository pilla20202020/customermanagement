<?php

namespace App\Modules\Models\Bill;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkin_id',
        'title',
        'rate',
        'quantity',
        'total',
        'date',
        'created_by',
        'updated_by',
    ];
}
