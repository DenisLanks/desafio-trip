<?php
namespace App\Repositories;

use App\Trip;
use Illuminate\Support\Facades\DB;

class TripRepository
{
    public function Create(array $input)
    {
        return Trip::create($input);
        //return DB::insert('insert into trips (`from`, `to`, `user`,`distance`, `price`) values (?, ?, ?, ?, ?)', $input);
    }

    public function getTrips(int $user)
    {
        return DB::table('trips')->where(['user'=>$user])->get();
    }
}

