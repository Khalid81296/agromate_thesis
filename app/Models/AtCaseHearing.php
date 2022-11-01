<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtCaseHearing extends Model
{
	use HasFactory;
	protected $table = 'at_case_hearing';
	protected $fillable = [
		'at_case_id','hearing_date','hearing_file', 'comments'
	];
}
