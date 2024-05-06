<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeersAromasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv(storage_path('csv/beers_aromas.csv'));

        foreach ($data as $row) {
            DB::table('beers_aromas')->insert($row);
        }
    }

    private function getDataFromCsv($path)
    {
        $file = fopen($path, 'r');
        $header = fgetcsv($file);
        $data = [];
        while ($row = fgetcsv($file)) {
            $data[] = array_combine($header, $row);
        }

        fclose($file);
        return $data;
    }
}
