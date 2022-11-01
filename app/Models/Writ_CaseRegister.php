<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Writ_CaseRegister extends Model
{
	use HasFactory;

	protected $table = 'writ__case_register';
	public $timestamps = true;

	protected $fillable = [
	'case_number'
	];

	public function subcategories(){
		return $this->hasMany('App\Writ_CaseRegister', 'upazila_id');
	}
    public function caseSF(){
		return $this->hasOne(Writ_CaseSF::class, 'case_id');
	}
    public function court(){
		return $this->hasOne(Court::class, 'id', 'court_id');
	}
    public function upazila(){
		return $this->hasOne(Upazila::class, 'id', 'upazila_id');
	}
    public function mouja(){
		return $this->hasOne(Mouja::class, 'id', 'mouja_id');
	}
    public function case_hearings(){
		return $this->hasMany(Writ_CaseHearing::class, 'case_id', 'id');
	}
}
