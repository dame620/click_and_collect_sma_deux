<?php

namespace App\Http\Resources;

use App\Http\Resources\PackageorenvelopResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'packageorenvelop'  => PackageorenvelopResource::make($this->packageorenvelop),
            'unit_price'        =>$this->unit_price,
            'quantity'          =>$this->quantity,
            'description'       =>$this->description,
            'product_type'      =>$this->product_type,
        ];
    }
}
