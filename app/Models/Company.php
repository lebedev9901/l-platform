<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'subdomain',
        'tariff',
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}
