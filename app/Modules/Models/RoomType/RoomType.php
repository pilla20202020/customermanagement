<?php

namespace App\Modules\Models\RoomType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'created_by',
        'updated_by',
    ];

}
