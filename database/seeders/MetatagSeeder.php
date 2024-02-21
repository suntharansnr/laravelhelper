<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetatagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the SQL file content
        $sqlContent = file_get_contents('db/metatags.sql');

        // Execute each query
        foreach (explode(';', $sqlContent) as $sqlQuery) {
            if (!empty(trim($sqlQuery))) {
                DB::statement($sqlQuery);
            }
        }

        $this->command->info('Metatags table seeded!');
    }
}
