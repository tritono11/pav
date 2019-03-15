<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'ip', 'remember_token',
    ];
}
