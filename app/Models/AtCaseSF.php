<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtCaseSF extends Model
{
	use HasFactory;
	protected $table = 'at_case_sf';

	protected $fillable = [
			'case_id','user_id','sf_details', 'send_date'
	];
}
