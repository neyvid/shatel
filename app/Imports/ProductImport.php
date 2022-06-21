<?php

namespace App\Imports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new product([
            'name' => $row[0],
            'price' => $row[1],
            'discount' => $row[2],
            'image_name' => $row[3],
            'description' => $row[4],
            'stock' => $row[5],
            'category_id' => $row[6],
        ]);
    }
}
