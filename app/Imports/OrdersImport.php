<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class OrdersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Order([
            'user_id' => $row[0],
            'price' => $row[1],
            'payable_amount' => $row[2],
            'discount_amount' => $row[3],
            'status' => $row[4],
            'refid' => $row[5],

        ]);
    }

}
