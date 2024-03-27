<?php

namespace Database\Seeders;

use App\Models\BeerLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeerLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv(storage_path('csv/beer_languages.csv'));

        $model = new BeerLanguage();
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
