<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtCaseBibadi extends Model
{
    use HasFactory;

    protected $table = 'at_case_bibadi';

    protected $fillable = [
            'at_case_id',
            'name',
            'designation',
            'address'
    ];

    // public function subcategories(){
    //  return $this->hasMany('App\CaseRegister', 'upazila_id');
    // }
}
