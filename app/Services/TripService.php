<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class TripService{

    protected $tripRepository;
    protected $cityRepository;

    public function __construct()
    {
        $this->tripRepository = app("App\Repositories\TripRepository");
        $this->cityRepository = app("App\Repositories\CityRepository");
    }
    public function getCities()
    {
        return $this->cityRepository->getAll();
    }
    public function getTrips(int $user)
    {
        return $this->tripRepository->getTrips($user);
    }
    public function create(array $input)
    {
        return $this->tripRepository->create($input);
    }

    public function calculate(array $input)
    {
        $from = DB::table('cities')->find($input["from"]);
        $to = DB::table('cities')->find($input["to"]);
        $x = $to->x - $from->x;
        $y = $to->y - $from->y;
        $distance = sqrt(($x*$x)+($y*$y)) * 1000;
        return [
            "distance"=>$distance,
            "price"=>$distance * 2
        ];
    }
}
