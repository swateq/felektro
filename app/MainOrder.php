<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainOrder extends Model
{
    


    /**
     * Relationships
     */

     public function orders()
     {
         return $this->hasMany('App\Order');
     }
}
