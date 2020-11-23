<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    private $cities = [
        [ "name"=>"'Roma'", "x"=>1.99, "y"=>2.99 ],
        [ "name"=>"'São Paulo'", "x"=>0.99, "y"=>0.09 ],
        [ "name"=>"'Rio de Janeiro'", "x"=>0.39, "y"=>0.02 ],
        [ "name"=>"'Salvador'", "x"=>1.09, "y"=>1.01 ],
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // foreach ($this->cities as $key => $city) {
        //     DB::raw("insert into cities (name, x, y) values ('$city->name', ?, ?)")
        //     DB::insert('insert into cities (name, x, y) values (?, ?, ?)', $city);
        // }
    }
}
