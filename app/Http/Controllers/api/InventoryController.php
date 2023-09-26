<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Plants;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function storePlant(Request $request)
    {
        $post = new Inventory;
        $post->rfid = $request->rfid;
        $post->id_plant = $request->id_plant;
       $post->save();

      
       return response()->json(['message' => 'Berhasil ditambahkan'], 201);
    }

    public function redeem(Request $request){
        
        $data = Inventory::where('rfid',$request->rfid)->first();
        if ($data) {
            $redeem = Inventory::find($data->id);
            $redeem->rfid = $data->rfid;
            $redeem->id_player = '1';
            $redeem->id_plant= $data->id_plant;
        }

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

    
        return response()->json($redeem, 200);
    }

 
}
