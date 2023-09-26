<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Plants;
use App\Models\Players;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $data = Players::all();

        return view('pages.index')->with([
            'data' => $data
        ]);
    }
    public function playerData(){
        $data = Players::all();

        return view('pages.player')->with([
            'data' => $data
        ]);
    }

    public function plantsData(){
        $data = Plants::all();

        return view('pages.plants')->with([
            'data' => $data
        ]);
    }
    public function cardData(){
        $data = Inventory::all();

        return view('pages.card')->with([
            'data' => $data
        ]);
    }
}
