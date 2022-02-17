<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AreacodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'areacode' => rand(2, 5) . rand(300, 900),
            'code' => '0' . rand(0, 50),
            'city_id' =>49,
            'province_id' => 4,
            'telecomcenter_id' => 317,
        ];
    }
}
