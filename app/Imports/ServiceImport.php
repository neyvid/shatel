<?php

namespace App\Imports;

use App\Models\service;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Services\JalaliDate\JalaliDate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ServiceImport implements ToCollection, WithHeadingRow
{
    protected $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository=new CategoryRepository();
    }

    public function collection(Collection $rows)
    {
        $service = [];
        foreach ($rows as $row) {
            $service = Service::create([
                'oprator_id' => $row['oprator_id'],
                'name' => $row['name'],
                'telecomcenter_id' => $row['telecomcenter_id'],
                'commission_price' => $row['commission_price'],
                'total_price' => $row['total_price'],
                'sell_price' => $row['sell_price'],
                'base_price' => $row['base_price'],
                'expire_date' => JalaliDate::convert_jalali_to_miladi($row['expire_date']),
                'available_id' => $row['available_id'],
                'category_id' => $row['category_id'],
                'price_id' => $row['price_id'],
                'service_id' => $row['service_id'],
                'type' => $row['type'],
                'plan' => $row['plan'],
                'discount' => $row['discount'],
                'period' => $row['period'],
                'night_trafic' => $row['night_trafic'],
                'speed' => $row['speed'],
                'limit_amount' => $row['limit_amount'],
                'international_trafic' => $row['international_trafic'],
                'description' => $row['description'],
                'price' => $row['price'],
            ]);
            $category = $this->categoryRepository->find($row['category_id']);
            $service->categories()->attach($category);
        }


    }
}
