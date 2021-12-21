<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['companyName','alumniPosition','companyHR','companyWebsite','companyEmail','companyLocation','companyImage'];
    protected $hidden = ['created_at', 'updated_at'];
}
