<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Reports extends Authenticatable
{
    protected $table ='report';

    public function collect()
    {
        return $this->belongsTo('App\Collect', 'collection_id');
    }
        
}