<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\AreacodeRepository\AreacodeRepository;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;
use function MongoDB\BSON\toJSON;

class BuyOnlineAdslController extends Controller
{
    protected $areacodeRepository;

    public function __construct()
    {
        $this->areacodeRepository = new AreacodeRepository();
    }

    public function buyOnline(Request $request)
    {
        $adslData = [
            'code' => $request->code,
            'areacode' => $request->areacode,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'telecomcenter_id' => $request->telecomcenter_id
        ];
        $isAreacode = $this->areacodeRepository->findBy($adslData);
        if ($isAreacode != ' ') {
            $isAreacode->city;
            $isAreacode->telecomcenter;
            $isAreacode->province;
            session(['orderDetails' => $isAreacode]);
            return $isAreacode;
        }

        return false;

    }

    public function getOrderDetailsSession()
    {
        if (session()->has('orderDetails')) {
            return ['status' => true, 'orderDetails' => session('orderDetails')];
        }
        return ['status' => false];
    }

    private static function checkSession()
    {
        if (session()->has('orderDetails')) {
            return true;
        }
        return false;
    }
}
