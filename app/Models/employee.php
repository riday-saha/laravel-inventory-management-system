<?php

namespace App\Models;

use App\Models\Salary;
use App\Models\employee;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function salaries(){
        return $this->hasMany(Salary::class);
    }
}
