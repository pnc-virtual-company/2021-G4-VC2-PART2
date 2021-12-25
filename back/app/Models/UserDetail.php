<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = ['gender','birthDate','batch','major','skills','city','maritalStatus', 'phoneNumber'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    protected $casts = [
        'skills' => 'array'
    ];
}

