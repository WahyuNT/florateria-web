<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Plants;
use App\Models\Players;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $player = Players::paginate(5);
        $plants = Plants::paginate(5);
        $inventory = Inventory::paginate(5);

        return view('pages.index')->with([
            'player' => $player,
            'plants' => $plants,
            'inventory' => $inventory,
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
    public function nfc(){
    

        return view('pages.nfc');
    }
}
