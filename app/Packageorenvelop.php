<?php

namespace App;

use App\User;
use App\Product;
use App\Shipment;
use Illuminate\Database\Eloquent\Model;

class Packageorenvelop extends Model
{
    protected $guarded=[];

    public function products(){

        return $this->hasMany(Product::class);
        
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shipment(){

        return $this->belongsTo(Shipment::class);
        
    }

    protected static function boot()
    {
       parent::boot();
    
       static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    public static function withDefaultStatus() {
        $status       = Statu::where('libelles', 'EN ATTENTE REGLEMENT')->first();
        $shipment_ids = $status->shipments->pluck('id');
        return self::whereIn('shipment_id', $shipment_ids)->get();
    }
    
    
}
