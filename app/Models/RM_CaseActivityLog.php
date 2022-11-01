<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RM_CaseActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_info',
        'rm_case_id',
        'activity_type',
        'massage',
        'old_data',
        'new_data'
    ];
}
