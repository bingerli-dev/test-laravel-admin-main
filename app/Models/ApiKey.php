<?php

namespace App\Models;

use App\Models\BaseModel;

class ApiKey extends BaseModel
{
    protected $fillable = [
        'client_id',
        'client_secret',
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}