<?php

namespace App\Models\service;

class ServicePlan
{
    const NEWYEAR = 1;
    const WINTER = 2;
    const FALL = 3;
    const SPRING = 4;
    const SUMMER = 5;

    public static function getServicePlan()
    {
        return [
            self::NEWYEAR => 'نوروزی',
            self::WINTER => 'زمستانه',
            self::FALL => 'پاییزه',
            self::SPRING => 'بهاره',
            self::SUMMER => 'تابستانه',

        ];
    }
    public static function getServiceplanWithKeyValue()
    {
        return [
            ['plan_name'=>'نوروزی','plan'=>self::NEWYEAR] ,
            ['plan_name'=>'زمستانه','plan'=>self::WINTER],
            ['plan_name'=>'پاییزه','plan'=>self::FALL],
            ['plan_name'=>'بهاره','plan'=>self::SPRING],
            ['plan_name'=>'تابستانه','plan'=>self::SUMMER],

        ];
    }

    public static function getServicePlanWithPlanNumber(int $planNumber)
    {
        return self::getServicePlan()[$planNumber];
    }
}
