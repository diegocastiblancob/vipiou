<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proposal extends Model
{
    //
    public function proposal_action(){
        return $this->hasMany('App\proposal_action');
    }

    public function customer(){
        return $this->belongsTo('App\customer', 'customer_id');
    }
}
