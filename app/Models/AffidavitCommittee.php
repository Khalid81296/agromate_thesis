<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffidavitCommittee extends Model
{
    use HasFactory;

    protected $table = 'affidavit_committee';
    public $timestamps = true;

    // protected $casts = [
    //     'cost' => 'float'
    // ];
    
    protected $fillable = [
        'name',
        'designation',
        'mobile_no',
        'email',
        'status',
        'created_at',
        'created_by'
    ];
}
