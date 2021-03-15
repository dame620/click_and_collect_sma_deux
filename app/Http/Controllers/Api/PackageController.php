<?php

namespace App\Http\Controllers\Api;
use App\Product;
use App\Shipment;
use App\Packageorenvelop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PackageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create() 
    {
        //dd(Auth::user());
        return view('/package/create');

    }
    public function store(Request $request){
        
        $created_wrappers = [];
		$created_products = [];
		$created_shipments = [];
		$packages = $request->get('data');

		$pack=$packages[0];
		
		$shipment=Shipment::create([
			'pickuppostalCode' => $pack['shipmentdetails']['pickuppostalCode'],
			'pickupcityName' => $pack['shipmentdetails']['pickupcityName'],
			'pickupcountryCode' => $pack['shipmentdetails']['pickupcountryCode'],
			'pickupaddressLine1' => $pack['shipmentdetails']['pickupaddressLine1'],
			'pickupcountyName' => $pack['shipmentdetails']['pickupcountyName'],
			'pickupemail' => $pack['shipmentdetails']['pickupemail'],
			'pickupphone' => $pack['shipmentdetails']['pickupphone'],
			'pickupmobilePhone' => $pack['shipmentdetails']['pickupmobilePhone'],
			'pickupcompanyName' => $pack['shipmentdetails']['pickupcompanyName'],
			'pickupfullName' => $pack['shipmentdetails']['pickupfullName'],
			'trackingnumber' => $pack['trackingnumber'],
			'labelbase64' => $pack['labelbase64'],
			'tatalprice'  => $pack['shipmentdetails']['tatalprice'],

			'receiverpostalCode' => $pack['shipmentdetails']['receiverpostalCode'],
			'receivercityName' => $pack['shipmentdetails']['receivercityName'],
			'receivercountryCode' => $pack['shipmentdetails']['receivercountryCode'],
			'receiveraddressLine1' => $pack['shipmentdetails']['receiveraddressLine1'],
			'receivercountyName' => $pack['shipmentdetails']['receivercountyName'],
			'receiveremail' => $pack['shipmentdetails']['receiveremail'],
			'receiverphone' => $pack['shipmentdetails']['receiverphone'],
			'receivermobilePhone' => $pack['shipmentdetails']['receivermobilePhone'],
			'receivercompanyName' => $pack['shipmentdetails']['receivercompanyName'],
			'receiverfullName' => $pack['shipmentdetails']['receiverfullName'],

		]);


		//$created_shipments[] = $shipment;

		foreach ($packages as $package) {
		
			
			$wrapper = Packageorenvelop::create([
				'shipment_id' => $shipment->id,
				'width'  => $package['width'],
				'height' => $package['height'],
				'length' => $package['length'],
				'weight' => $package['weight'],
				'origincountry'=> $package['origincountry'],
                'destinationcountry'=> $package['destinationcountry'],
				'trackingnumber' => $package['trackingnumber'],
				'labelbase64' => $package['labelbase64'],
				'is_smallformat' => false,
                'is_bigformat'=> false,
				'is_nophytho' => $package['is_nophytho'],
				'is_phythoexiste' => $package['is_phythoexiste'],
				'is_phytho_your_own' => $package['is_phytho_your_own'],
				'is_phytho_provide_tosma' => $package['is_phytho_provide_tosma'],	
				'is_origincertificat'=> $package['is_origincertificat'],
            	'is_noorigincertificat'=> $package['is_noorigincertificat'],
            	'is_origin_certificat_your_own'=> $package['is_origin_certificat_your_own'],
                'is_origin_certificat_provide_to_sma'=> $package['is_origin_certificat_provide_to_sma'],
                
			]);



			$created_wrappers[] = $wrapper;

			
			

			if (count($package['products']) > 0) {
				foreach($package['products'] as $product) {
					$created_products[] = Product::create([
						'unit_price'       => $product['unit_price'],
						'quantity'   => $product['quantity'],
                        'product_type' => $product['product_type'],
                        'description' => $product['description'],
                        'packageorenvelop_id' => $wrapper->id,
                        
					]);
				}
			}
        }	
       // dd($request->ajax());
	   //$request->session()->flash('status', 'Task was successful!');
	   //Session::flash('success', "le paquet a été bien savegarder");
	  // return redirect()->route('package.create')->with('success', 'le paquet a été bien enregistrer');
	   
		if ($request->ajax()) {
			
			return ['success' => true, 'wrappers' => $created_wrappers, 'products' => $created_products, 'shipment'=>$shipment];
			
		}


    }

}
