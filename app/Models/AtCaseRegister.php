<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Court;
use App\Models\Division;
use App\Models\District;
use App\Models\User;

class AtCaseRegister extends Model
{
    use HasFactory;

    protected $table = 'at_case_register';

    protected $fillable = [
            'case_no',
            'case_date',
            'action_user_id',
            'case_status_id',
            'court_id',
            'district_id',
            'division_id',
            'notice_file',
            'sf_scan1',
            'sf_scan2',
            'result',
            'result_file',
            'case_reason',
            'sf_deadline',
            'status',
            'comments',
            'in_favour_govt',
            'user_id',
            'govt_lost_reason',
            'advocate_id',
            'is_appeal',

    ];

    public function court(){
     return $this->hasOne(Court::class,'id', 'court_id');
    }

    public function division(){
     return $this->hasOne(Division::class,'id', 'division_id');
    }

    public function district(){
     return $this->hasOne(District::class,'id', 'district_id');
    }

    public function advocate(){
     return $this->hasOne(User::class,'id', 'advocate_id');
    }

    public function case_status(){
        return $this->hasOne(CaseStatus::class, 'id', 'case_status_id');
    }
    public function badis(){
        return $this->hasMany(AtCaseBadi::class, 'at_case_id', 'id');
    }
    public function bibadis(){
        return $this->hasMany(AtCaseBibadi::class, 'at_case_id', 'id');
    }
    public function hearings(){
        return $this->hasMany(AtCaseHearing::class, 'at_case_id', 'id')->orderby('id', 'DESC');
    }
}
