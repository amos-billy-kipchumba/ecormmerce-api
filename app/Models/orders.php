<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'total_price',
        'date_of_delivery',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function location(){
        return $this->hasOne('App\Models\location', 'id', 'location_id');
    } 

    public function items(){
        return $this->hasMany('App\Models\order_items', 'order_id', 'id');
    }

}
