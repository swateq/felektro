<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['main_order_id','dok_id','subiekt_number','symbol','name','product_id','client_type','client','status','quantity','done_quantity','archive','accepted','accepted_date'];

    /**
     * Relationships
     */

    public function main_order()
    {
        return $this->belongsTo('App\MainOrder');
    }

    public function order_positions()
    {
        return $this->hasMany('App\OrderPosition');
    }
}
