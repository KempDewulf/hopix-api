<?php

namespace Database\Seeders;

use App\Models\Beer;
use App\Models\Aroma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $rown = 0;

        $sweetAroma = Aroma::where('name', 'sweet')->first();
        $oakAroma = Aroma::where('name', 'oak')->first();

        foreach ($data as $row) {
            $beer = $model->create($row);

            if ($rown == 0) {
                $beer->aromas()->attach($sweetAroma);
            } else {
                $beer->aromas()->attach($oakAroma);
            }

            $rown++;
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
