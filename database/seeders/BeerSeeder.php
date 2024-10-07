<?php

namespace Database\Seeders;

use App\Models\Beer;
use Illuminate\Database\Seeder;

class BeerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv(storage_path('csv/beers.csv'));

        $model = new Beer();
        foreach ($data as $row) {
            $model->create($row);
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
