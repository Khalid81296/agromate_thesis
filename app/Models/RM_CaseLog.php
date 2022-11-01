<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RM_CaseLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'rm_case_id',
        'case_status_id',
        'user_id',
        'sender_user_role_id',
        'receiver_user_role_id',
        'comments'
    ];

    public function case_status(){
        return $this->hasOne(CaseStatus::class, 'id', 'case_status_id');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function role(){
        return $this->hasOne(Role::class, 'id', 'sender_user_role_id');
    }
}
