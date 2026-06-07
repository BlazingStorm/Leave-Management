<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'employee_id' , 'mobile' , 'department' , 'designation' , 'manager_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class , 'manager_id');
    }

    public function subortinates()
    {
        return $this->hasMany(Employee::class , 'manager_id');
    }

    
}
