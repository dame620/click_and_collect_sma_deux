<?php

namespace App;

use App\Shipment;
use App\Packageorenvelop;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'telephone', 'adresse', 'date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profil(){

        return $this->hasOne(Profil::class);

    }

    public function packageorenvelops(){

        return $this->hasMany(Packageorenvelop::class);

    }

    public function shipments(){
        return $this->hasMany(Shipment::class);
    }

    protected static function boot(){

        parent::boot();

        //ce created is an event
        static::created(function ($user){
            $user->profil()->create([
                'title'=>$user->name,
            ]);
        });

    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
