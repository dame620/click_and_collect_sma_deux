<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DhlController extends Controller
{
  
    public function index(Request $request)
    {  
        $packages = $request->packages;
        $responses = [];
        foreach($packages as $package) {
            $response = $this->getRates($package['origincountry'],$package['originregion'],$package['destinationcountry'],$package['destinationregion'],$package['pickupdate'],$package['length'],$package['weight'],$package['width'],$package['height']);
            array_push($responses, json_decode($response));
        }

        return ['responses' => $responses];
    }

         
   

    //function qui gere la logique du quote 
    private function getRates($origincountry, $originregion, $destinationcountry, $destinationregion, $pickupdate, $length, $weight, $width, $height) {
        $newDate = Carbon::now()->addDays(5);
        $fifthday=$newDate->toDateString();
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://express.api.dhl.com/mydhlapi/test/rates?accountNumber=403022667&originCountryCode=$origincountry&originCityName=$originregion&destinationCountryCode=$destinationcountry&destinationCityName=$destinationregion&plannedShippingDate=$pickupdate&isCustomsDeclarable=true&length=$length&weight=$weight&width=$width&height=$height&unitOfMeasurement=metric",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Basic c2hvcG1lYXdheXNTTjpRXjd0QiEyYkpANm0=",
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "postman-token: be5cfb1a-9ab7-eb0b-79f5-649c3be1a498"
        ),
        ));
     

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        //return ['response' => $response];
        return $response;

    }

    //cette foncion est appelé par les composent pour donner le shipment
    public function storeshipment(Request $request){
        $packages=$request->packages;
        $responses = [];
        foreach($packages as $package){
            
            $response=$this->getshipment($package['weight'], $package['length'], $package['width'], $package['height'], $package['pickuppostalCode'] , $package['pickupcityName'], $package['pickupcountryCode'],  $package['pickupaddressLine1'], $package['pickupcountyName'], $package['pickupemail'], $package['pickupphone'], $package['pickupmobilePhone'], $package['pickupcompanyName'], $package['pickupfullName'], $package['pickupdate'], $package['receiverpostalCode'] , $package['receivercityName'], $package['receivercountryCode'],  $package['receiveraddressLine1'], $package['receivercountyName'], $package['receiveremail'], $package['receiverphone'], $package['receivermobilePhone'], $package['receivercompanyName'], $package['receiverfullName']);
            array_push($responses, $response);
        }
        return ['responses' => $responses];
    }


    public function getshipment($weight, $length, $width, $height, $pickuppostalCode, $pickupcityName, $pickupcountryCode, $pickupaddressLine1, $pickupcountyName, $pickupemail, $pickupphone, $pickupmobilePhone, $pickupcompanyName, $pickupfullName, $pickupdate, $receiverpostalCode, $receivercityName, $receivercountryCode, $receiveraddressLine1, $receivercountyName, $receiveremail, $receiverphone, $receivermobilePhone, $receivercompanyName, $receiverfullName)
    {
       


        //start second request 2021-02-26T14:00:31GMT+00:00
        //2010-02-11T17:10:09 GMT+01:00
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://express.api.dhl.com/mydhlapi/test/shipments',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "plannedShippingDateAndTime": "'.$pickupdate.'GMT+00:00",
            
            
            "pickup": {
              "isRequested": false,
              "closeTime": "18:00",
              "pickupDetails": {
                "postalAddress": {
                  "postalCode": "'.$pickuppostalCode.'",
                  "cityName": "'.$pickupcityName.'",
                  "countryCode": "'.$pickupcountryCode.'",
                  "addressLine1": "'.$pickupaddressLine1.'",
                  "addressLine2": "addres2",
                  "addressLine3": "addres3",
                  "countyName": "'.$pickupcountyName.'"
                },
                "contactInformation": {
                  "email": "'.$pickupemail.'",
                  "phone": "'.$pickupphone.'",
                  "mobilePhone": "'.$pickupmobilePhone.'",
                  "companyName": "'.$pickupcompanyName.'",
                  "fullName": "'.$pickupfullName.'"
                }
              }
            },
            "productCode": "P",
            "accounts": [
              {
                "typeCode": "shipper",
                "number": "403022667"
              }
            ],
            "customerDetails": {
              "shipperDetails": {
                "postalAddress": {
                  "postalCode": "'.$pickuppostalCode.'",
                  "cityName": "'.$pickupcityName.'",
                  "countryCode": "'.$pickupcountryCode.'",
                  "addressLine1": "'.$pickupaddressLine1.'",
                  "addressLine2": "addres2",
                  "addressLine3": "addres3",
                  "countyName": "'.$pickupcountyName.'"
                },
                "contactInformation": {
                  "email": "'.$pickupemail.'",
                  "phone": "'.$pickupphone.'",
                  "mobilePhone": "'.$pickupmobilePhone.'",
                  "companyName": "'.$pickupcompanyName.'",
                  "fullName": "'.$pickupfullName.'"
                }
              },
              "receiverDetails": {
                "postalAddress": {
                  "postalCode": "",
                  "cityName": "'.$receivercityName.'",
                  "countryCode": "'.$receivercountryCode.'",
                  "addressLine1": "'.$receiveraddressLine1.'",
                  "addressLine2": "addres2",
                  "addressLine3": "addres3",
                  "countyName": "'.$receivercountyName.'"

                },
                "contactInformation": {
                  "email": "'.$receiveremail.'",
                  "phone": "'.$receiverphone.'",
                  "mobilePhone": "'.$receivermobilePhone.'",
                  "companyName": "'.$receivercompanyName.'",
                  "fullName": "'.$receiverfullName.'"
                }
              }
              },
            "content": {
              "packages": [
                {
                  "weight": '.$weight.',
                  "dimensions": {
                    "length": ' .$length. ',
                    "width": '.$width.',
                    "height": '.$height.'
                  },
                  "customerReferences": [
                    {
                      "value": "Customer reference"
                    }
                  ],
                  "description": "Piece content description",
                  "labelText": [
                    { 
                      "position": "left",
                      "caption": "text caption",
                      "value": "text value"
                    }
                  ],
                  "labelDescription": "bespkoe label description"
                }
              ],
              "isCustomsDeclarable": true,
              "declaredValue": 10,
              "declaredValueCurrency": "USD",
              "description": "line item description",
              "incoterm": "DAP",
              "unitOfMeasurement": "metric"
              },
            "shipmentNotification": [
              {
                "typeCode": "email",
                "receiverId": "test@gmail.com",
                "languageCode": "eng",
                "languageCountryCode": "en",
                "bespokeMessage": "message to be included in the notification"
              }
            ]
          }',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic c2hvcG1lYXdheXNTTjpRXjd0QiEyYkpANm0=',
            'Content-Type: application/json',
            'Cookie: BIGipServer~WSB~pl_wsb-express-chd.dhl.com_443=308824229.64288.0000'
          ),
        ));
     

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

        //end second request

    }


}
