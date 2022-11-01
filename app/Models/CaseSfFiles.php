<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseSfFiles extends Model
{
    use HasFactory;
	protected $table = 'case_sf_files';
    protected $fillable = [
        'case_id',
        'file_type',
        'file_name',
    ];
}
