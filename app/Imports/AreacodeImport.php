<?php

namespace App\Imports;

use App\Models\areacode;
use Maatwebsite\Excel\Concerns\ToModel;

class AreacodeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new areacode([
            'city_id' => $row[0],
            'province_id' => $row[1],
            'telecomcenter_id' => $row[2],
            'areacode' => $row[3],
            'code' => $row[4],
        ]);
    }
}
