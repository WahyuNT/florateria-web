<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $test = 'berhasil';
        return response()->json($test);

    }

    public function kirim(Request $request){
        $post = new Players;
         $post->nama = $request->name;
         $post->password = $request->password;
        $post->save();

        // Respon suks
        return response()->json(['message' => 'Post berhasil disimpan'], 201);
    }

    }

