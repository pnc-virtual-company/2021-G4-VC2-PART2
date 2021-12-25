<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'companyName','alumniPosition','companyHR','companyWebsite','companyEmail','companyLocation'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
