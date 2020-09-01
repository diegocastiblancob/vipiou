<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task_action extends Model
{

    public function task(){
        return $this->belongsTo('App\task', 'task_id');
    }
}
