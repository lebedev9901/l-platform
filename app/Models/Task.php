<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'status',
        'deadline'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_task', 'task_id', 'employee_id')->withTimestamps();
    }
}
