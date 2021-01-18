<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Reseller extends Authenticatable
{
    use Notifiable;
    protected $guard = 'reseller';
}
