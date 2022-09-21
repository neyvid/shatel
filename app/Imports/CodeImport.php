<?php

namespace App\Imports;

use App\Models\Code;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CodeImport implements ToCollection,WithHeadingRow
{


    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Code::create([
                'code_id' => $row['code_id'],
                'areacode' => $row['areacode'],
                'province' => $row['province'],
                'city' =>$row['city'],
                'telecomcenter' => $row['telecomcenter'],
            ]);

        }

    }
}
