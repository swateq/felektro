<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPosition extends Model
{
    



    /**
     * Relationships
     */

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
