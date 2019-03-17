<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiScopes extends Model
{
    protected $table = 'api_scopes';
    protected $fillable = [
        'name',
        'title',
        'app_id'
    ];
}
