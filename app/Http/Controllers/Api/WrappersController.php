<?php

namespace App\Http\Controllers\Api;

use App\Statu;
use App\Packageorenvelop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PackageorenvelopResource;

class WrappersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        return PackageorenvelopResource::collection($user->packageorenvelops);
    }

    public function show(int $id)
    {
        $wrapper = Auth::user()->packageorenvelops()->where('id', $id)->first();

        if ($wrapper) {
            return PackageorenvelopResource::make($wrapper);
        }

        return response()->json([
            'success' => false,
            'message' => "Le paquet n'a pas pu être retrouvé dans notre système."
        ], 401);
        
    }

    public function showdefault(){
        $packages = Packageorenvelop::withDefaultStatus();
        return PackageorenvelopResource::collection($packages);        
    }

    public function showall(){
        return PackageorenvelopResource::collection(Packageorenvelop::all());
    }
}
