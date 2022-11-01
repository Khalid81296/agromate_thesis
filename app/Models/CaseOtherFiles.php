<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseOtherFiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_id',
        'file_type',
        'file_name',
    ];
}
