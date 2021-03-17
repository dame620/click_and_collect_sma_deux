<?php

namespace App\Http\Resources;

use App\Http\Resources\ProfileResource;
use App\Http\Resources\ShipmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'telephone'         => $this->telephone,
            'dateofbirth'       => $this->dateofbirth,
            'adresse'           => $this->adresse,
            //'profil'            => ProfileResource::make($this->profil),
            'packageorenvelops' => $this->packageorenvelops,
            'shipments'         => $this->shipments,
        ];
    }
}
