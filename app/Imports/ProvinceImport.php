<?php

namespace App\Imports;

use App\Models\Province;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\Mime\Header\HeaderInterface;

class ProvinceImport implements ToCollection,WithHeadingRow
{

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
             Province::create([
                'name' => $row['name'],
                'code' => $row['code'],


            ]);

        }

    }
}
