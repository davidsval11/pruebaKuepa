<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programass')->insert(
            [
                [
                    'nombre' => 'Bachillerato',
                ],
                [
                    'nombre' => 'Inglés',
                ],
                [
                    'nombre' => 'Preicfes',
                ]
            ]
        );
    }
}
