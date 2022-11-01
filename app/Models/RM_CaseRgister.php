<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Court;
use App\Models\Division;
use App\Models\District;
use App\Models\RM_CaseType;
use App\Models\CaseStatus;
use App\Models\Role;
use App\Models\Upazila;
use App\Models\Mouja;
use App\Models\User;

class RM_CaseRgister extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_no',
        'case_date',
        'action_user_role_id',
        'district_id',
        'division_id',
        'upazila_id',
        'arji_file',
        'result',
        'result_file',
        'case_reason',
        'status',
        'comments',
        'in_favour_govt',
        'user_id',
        'govt_lost_reason',
        'is_appeal',
        'rm_case_ref_id',
        'ref_rm_case_no',
        'case_type_id',
        'case_status_id',
        'mouja_id'
    ];

    public function court(){
        return $this->hasOne(Court::class,'id', 'court_id');
    }
    public function role(){
        return $this->hasOne(Role::class,'id', 'action_user_role_id');
    }

    public function division(){
        return $this->hasOne(Division::class,'id', 'division_id');
    }

    public function district(){
        return $this->hasOne(District::class,'id', 'district_id');
    }

    public function upazila(){
        return $this->hasOne(Upazila::class,'id', 'upazila_id');
    }

    public function mouja(){
        return $this->hasOne(Mouja::class,'id', 'mouja_id');
    }

    public function advocate(){
        return $this->hasOne(User::class,'id', 'advocate_id');
    }

    public function case_status(){
        return $this->hasOne(CaseStatus::class, 'id', 'case_status_id');
    }

    public function case_type(){
        return $this->hasOne(RM_CaseType::class, 'id', 'case_type_id');
    }
    public function badis(){
        return $this->hasMany(RM_CaseBadi::class, 'rm_case_id', 'id');
    }
    public function bibadis(){
        return $this->hasMany(RM_CaseBibadi::class, 'rm_case_id', 'id');
    }
    public function hearings(){
        return $this->hasMany(RM_CaseHearing::class, 'rm_case_id', 'id')->orderby('id', 'DESC');
    }


}
