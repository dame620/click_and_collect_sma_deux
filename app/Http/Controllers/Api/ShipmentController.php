<?php

namespace App\Http\Controllers\Api;

use App\Shipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PackageResource;
use App\Http\Resources\ShipmentResource;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showall(){
        return ShipmentResource::collection(Shipment::all());
    }

    public function show(int $id){

      $shipment = Shipment::where('id', $id)->first();
      return ShipmentResource::make($shipment);
    }

    public function showshipuser(){
        //get the connected user
        $user_connected=Auth::user();

        $shipment_ids = $user_connected->packageorenvelops->map(function($package) {
            return $package->shipment_id; 
        });
        //list shipment for the connected user is here
        $shipments = Shipment::whereIn('id', $shipment_ids)->paginate(5);
        //$shipmentiteminsinglepage = Shipment::paginate(5);

        return ShipmentResource::collection($shipments);
    }
}
