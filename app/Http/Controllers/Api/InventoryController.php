<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Plants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InventoryController extends Controller
{
    public function storePlant(Request $request)
    {
        $post = new Inventory;
        $post->rfid = $request->rfid;
        $post->id_plant = $request->id_plant;
       $post->save();

       
       return redirect()->back()->with('success', 'Berhasil Menambahkan RFID');   

    }

    public function redeem(Request $request){

        $rfid = $request->rfid;
        if ($request->rfid) {
            $rfid = $request->rfid;
            if (substr($request->rfid, 0, 2) === "en") {
                $rfid = substr($rfid, 2); // Menghapus dua karakter pertama "en"
            }
        }
        $data = Inventory::where('rfid',$rfid)->first();

        if ($data) {
            $redeem = Inventory::find($data->id);
            $redeem->rfid = $data->rfid;
            if ($request->id_player){

                $redeem->id_player = $request->id_player;
            }
            if ($request->custom_name){

                $redeem->custom_name = $request->custom_name;
            }
            $redeem->id_plant= $data->id_plant;
            $redeem->save();
        }

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        if (!$rfid) {
            return response()->json(['message' => 'rfid kosong'], 404);
        }

    
        return response()->json($redeem, 200);
    }

    public function plants(Request $request){
        
        $data = Inventory::join('plants', 'inventory.id_plant', '=', 'plants.id')
        ->select('inventory.*', 'plants.icon','plants.name')
        ->where('id_player', $request->id_player)
        ->get();
        
        
        return response()->json($data, 200);
    }
    public function findCard(Request $request){
        
        $data = Inventory::where('rfid',$request)->first();
        
        
        return response()->json($data, 200);
    }

 
}
