<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Players;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $post = new Players;
        $post->name = $request->name;
        $post->password = $request->password;
        $post->id_role = '1';
       $post->save();

      
       return response()->json(['message' => 'Berhasil daftar'], 201);
    }

    public function login(Request $request)
    {
        $data = Players::where('name', $request->name)
                        ->where('password', $request->password)
                        ->first();
    
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        return response()->json($data, 200);
    }
}
