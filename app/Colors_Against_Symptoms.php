<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Colors_Against_Symptoms extends Authenticatable
{
    protected $table ='colors_against_symptoms';
    
}