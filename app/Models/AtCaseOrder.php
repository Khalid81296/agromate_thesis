<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtCaseOrder extends Model
{
    use HasFactory;

    protected $table = 'at_case_order';

    protected $fillable = [
            'at_case_id',
            'order_by',
            'section',
            'date'
    ];

    // public function subcategories(){
    //  return $this->hasMany('App\CaseRegister', 'upazila_id');
    // }
}
