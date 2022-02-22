<?php

namespace App\Models\service;

class ServiceType
{
    const NORMAL=1;
    const SPECIAL=2;
    const FESTIVAL=3;
    const VIP=4;
    public static function getServiceType()
    {
        return [
            self::NORMAL=>'عادی',
            self::SPECIAL=>'ویژه',
            self::FESTIVAL=>'جشنواره',
            self::VIP=>'VIP',

        ];
    }
    public static function getServiceTypeWithKeyValue()
    {
        return [
            ['type_name'=>'عادی','type'=>self::NORMAL] ,
            ['type_name'=>'ویژه','type'=>self::SPECIAL],
            ['type_name'=>'جشنواره','type'=>self::FESTIVAL],
            ['type_name'=>'VIP','type'=>self::VIP],

        ];
    }

    public static function getServiceTypeWithTypeNumber(int $numberOfType)
    {
        return self::getServiceType()[$numberOfType];

    }
}
