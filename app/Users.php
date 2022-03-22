<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chat_id', 'type',
    ];

}