<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $fillable = [
        'name','address'
    ];

    public function actions()
    {
        return $this->HasMany('App\Models\Action');
    }
}
