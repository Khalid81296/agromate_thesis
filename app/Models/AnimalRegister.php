<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalRegister extends Model
{
	use HasFactory;

	protected $table = 'animal_register';
	public $timestamps = true;

	protected $fillable = [
	'gender'
	];
}
