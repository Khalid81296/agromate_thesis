<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advocate extends Model
{
    use HasFactory;

    protected $table = 'advocate_details';
    public $timestamps = true;

    // protected $casts = [
    //     'cost' => 'float'
    // ];
   
    protected $fillable = [
        'name',
        'mobile_no',
        'email',
        'present_address',
        'permanent_address',
        'status',
        'created_at',
        'created_by'
    ];
}
