<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Passenger extends Authenticatable
{
    protected $table ='tracing_passenger';
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function collection()
    {
        return $this->belongsTo('App\Collect', 'collection_id');
    }
}