<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RM_CaseHearing extends Model
{
    use HasFactory;
    protected $fillable = [
		'rm_case_id','hearing_date','hearing_file', 'comments', 'hearing_result_file', 'hearing_result_comments'
	];

	public function rm_case_rgister(){
        return $this->hasOne(RM_CaseRgister::class, 'id', 'rm_case_id')->orderby('id', 'DESC');
    }
}
