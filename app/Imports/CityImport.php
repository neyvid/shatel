<?php

namespace App\Imports;

use App\Models\City;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CityImport implements ToCollection,WithHeadingRow
{


    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            City::create([
                'name' => $row['name'],
                'province_id' => $row['province_id'],


            ]);

        }

    }
}
