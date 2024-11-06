<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Reservation;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations()->with('shop')->get();
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = auth()->user()->favorites()->pluck('shop_id')->toArray();
        return view('mypage.index', compact('reservations', 'areas', 'genres','favorites'));
    }
}
