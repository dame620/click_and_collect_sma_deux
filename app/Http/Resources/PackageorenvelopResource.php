<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\ShipmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageorenvelopResource extends JsonResource
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
            'id'            => $this->id,
            'height'        => $this->height,
            'weight'        => $this->weight,
            'length'        => $this->length,
            'width'         => $this->width,
            'trackingnumber'=>$this->trackingnumber,
            'labelbase64'   => $this->labelbase64,
            'packageprice'  => $this->packageprice,
            'user'          => UserResource::make($this->user),
            'shipment'      => $this->shipment,
            'products'      => $this->products
        ];
    }
}
