<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $tripService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->tripService = app('App\Services\TripService');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getTrips($id)
    {
       return $this->tripService->getTrips($id);
    }
    public function getCities()
    {
        return $this->tripService->getCities();
    }

    public function saveTrip(Request $request)
    {
        return $this->tripService->create($request->all(['from', 'to', 'user','distance', 'price']));
    }

    public function calculate(Request $request)
    {
        return $this->tripService->calculate($request->all());
    }
}
