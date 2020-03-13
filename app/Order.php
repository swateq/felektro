<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{



    /**
     * Relationships
     */

    public function main_order()
    {
        return $this->belongsTo('App\MainOrder');
    }
}
