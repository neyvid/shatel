<?php

namespace App\Imports;

use App\Models\service;
use Maatwebsite\Excel\Concerns\ToModel;

class ServiceImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new service([
            'oprator_id' => $row[0],
            'name' => $row[1],
            'telecomcenter_id' => $row[2],
            'commission_price' => $row[3],
            'total_price' => $row[4],
            'sell_price' => $row[5],
            'base_price' => $row[6],
            'expire_date' => $row[7],
            'available_id' => $row[8],
            'available_id' => $row[8],
            'category_id' => $row[9],
            'price_id' => $row[10],
            'service_id' => $row[11],
            'type' => $row[12],
            'plan' => $row[13],
            'discount' => $row[14],
            'period' => $row[15],
            'night_trafic' => $row[16],
            'speed' => $row[17],
            'limit_amount' => $row[18],
            'international_trafic' => $row[19],
            'description' => $row[20],
            'price' => $row[21],
        ]);
    }
}
