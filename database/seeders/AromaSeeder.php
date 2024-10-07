<?php

namespace Database\Seeders;

use App\Models\Aroma;
use Illuminate\Database\Seeder;

class AromaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv(storage_path('csv/aromas.csv'));

        $model = new Aroma();
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
