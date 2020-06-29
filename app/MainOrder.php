<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainOrder extends Model
{
    protected $fillable = ['date','dok_id','subiekt_number','client','status','quantity','done_quantity','archive','accepted','accepted_date'];
    /**
     * Relationships
     */

     public function orders()
     {
         return $this->hasMany('App\Order');
     }
}
