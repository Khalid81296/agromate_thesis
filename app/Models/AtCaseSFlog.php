<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtCaseSFlog extends Model
{
	use HasFactory;

	protected $table = 'at_case_sf_log';

	protected $fillable = [
			'at_case_id','user_id','sf_log_details'
	];
}
