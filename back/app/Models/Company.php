<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'companyName', 'companyImage'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function companyDetail(){
        return $this->belongsTo(CompanyDetail::class);
    }

    public function userDetail(){
        return $this->belongsTo(UserDetail::class);
    }
}
