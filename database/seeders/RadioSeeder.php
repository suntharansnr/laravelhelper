<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;


class RadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Radio::factory(100)->create(); 
    }
}
