<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv(storage_path('csv/languages.csv'));

        $model = new Language();
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
