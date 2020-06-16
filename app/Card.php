<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Card extends Authenticatable
{
    protected $table ='my_cards';
    
    protected $fillable = [
        'card_no' ];
    
}