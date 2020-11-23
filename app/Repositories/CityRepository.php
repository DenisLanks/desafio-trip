<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CityRepository
{
    public function getAll()
    {
        return DB::table('cities')->get();
    }
}

