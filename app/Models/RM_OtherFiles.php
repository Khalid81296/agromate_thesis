<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RM_OtherFiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'rm_case_id',
        'file_type',
        'file_name',
    ];
}
