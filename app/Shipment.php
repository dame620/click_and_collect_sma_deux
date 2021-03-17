<?php

namespace App;

use App\User;
use App\Statu;
use App\Packageorenvelop;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded=[];
    
    public function packageorenvelops(){

        return $this->hasMany(Packageorenvelop::class);
        
    }

    public function statu(){

        return $this->belongsTo(Statu::class);
        
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected static function boot(){
 
        parent::boot();

        $status = Statu::where('libelles', 'EN ATTENTE REGLEMENT')->first();
    
        //ce created is an event
        static::creating(function ($shipment) use ($status) {
            $shipment->statu_id = $status->id;
            $shipment->user_id = auth()->id();
        });
    
    }

}
