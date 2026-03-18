<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'role',
        'pin_code'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'employee_task', 'employee_id', 'task_id')->withTimestamps();
    }
}
