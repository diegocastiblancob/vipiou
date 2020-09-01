<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proposal_action extends Model
{
    //
    public function proposal(){
        return $this->belongsTo('App\proposal', 'proposal_id');
    }
}
