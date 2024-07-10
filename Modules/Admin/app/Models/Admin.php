<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait,HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'mobile',
        'password',
    ];

}
