<?php

namespace App\Services\JalaliDate;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;


class JalaliDate
{
    public static function get_date_in_jalali_without_time(Carbon $carbon)
    {
        return Verta::instance($carbon)->format('j %B %Y');
    }

    public static function get_date_in_jalali($date)
    {
        $year = substr($date, 0, 4);
        $mount = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        $expire_date_jalali = Verta::getJalali("$year", "$mount", "$day");
        return $expire_date_jalali;
    }

    public static function convert_miladi_to_jalali($miladiDate)
    {
        $year = substr($miladiDate, 0, 4);
        $mount = substr($miladiDate, 5, 2);
        $day = substr($miladiDate, 8, 2);
        $expire_date_jalali = Verta::getJalali("$year", "$mount", "$day");
        $expire_date_farsi = Carbon::createFromDate($expire_date_jalali[0], $expire_date_jalali[1], $expire_date_jalali[2], 'Asia/Tehran')->toDateString();
        return $expire_date_farsi;
    }

    public static function convert_jalali_to_miladi($jalaliDate)
    {
        $year = substr($jalaliDate, 0, 4);
        $mount = substr($jalaliDate, 5, 2);
        $day = substr($jalaliDate, 8, 2);
//        convert from Jalali Date to Miladdi for insert to Db
        $expire_date_milladi = Verta::getGregorian("$year", "$mount", "$day");
        $expire_date_english = Carbon::createFromDate($expire_date_milladi[0], $expire_date_milladi[1], $expire_date_milladi[2], 'Asia/Tehran')->toDateString();
        return $expire_date_english;
    }
}
