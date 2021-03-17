<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
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
            'id'                 => $this->id,
            'pickupcityName'     => $this->pickupcityName,
            'labelbase64'        => $this->labelbase64,
            'trackingnumber'     => $this->trackingnumber,
            'pickupcountyName'   => $this->pickupcountyName,
            'receivercountyName' => $this->receivercountyName,
            'tatalprice'         => $this->tatalprice,
            'pickupcityName'     => $this->pickupcityName,
            'pickupfullName'     => $this->pickupfullName,
            'receiverfullName'   => $this->receiverfullName,
            'receivercityName'   => $this->receivercityName,
            'created_at'         => $this->created_at,
            'statu'              => $this->statu,
            'user'               => UserResource::make($this->user),
            'packageorenvelops'  => PackageorenvelopResource::collection($this->packageorenvelops),
        ];
    }
}
