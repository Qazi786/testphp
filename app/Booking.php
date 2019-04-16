<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = ['pickup_date_and_time', 'pickup_address', 'dropoff_address', 'weight','length','width','height','user_id','extra_option','status','price'];
     
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}