<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class credit extends Model
{
    public function sale(){
        return $this->belongsTo('App\sale', 'sale_id');
    }

}
