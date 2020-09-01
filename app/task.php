<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    public function task_action(){
        return $this->hasMany('App\task_action');
    }
    public function customer(){
        return $this->belongsTo('App\customer', 'customer_id');
    }
}
