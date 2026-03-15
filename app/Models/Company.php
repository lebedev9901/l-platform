<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'subdomain',
        'tariff'
    ];
    
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
