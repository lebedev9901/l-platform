<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            if(app()->has('company')){
                $model->company_id = app('company')->id;
            }
        });
    }

    protected $fillable = [
        'company_id',
        'title',
        'description'
    ];
}
