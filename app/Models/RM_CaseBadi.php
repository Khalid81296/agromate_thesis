<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RM_CaseBadi extends Model
{
    use HasFactory;
    protected $fillable = [
        'rm_case_id',
        'name',
        'spouse_name',
        'address'
];
}
