<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\service\ServicePlan;
use App\Models\service\ServiceType;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Repositories\OpratorRepository\OpratorRepository;
use App\Repositories\ServiceRepository\ServiceRepository;
use App\Repositories\TelecomcenterRepository\TelecomcenterRepository;
use App\Services\JalaliDate\JalaliDate;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepository;
    protected $opratorRepository;
    protected $telecomcenterRepository;
    protected $categoryRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository();
        $this->opratorRepository = new OpratorRepository();
        $this->telecomcenterRepository = new TelecomcenterRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function all()
    {
        $services = $this->serviceRepository->all(['oprator', 'telecomcenter']);
        $categories = $this->categoryRepository->all();
        foreach ($services as $service) {
            $service['type'] = $service->type_name;
            $service['plan'] = $service->plan_name;
            $service['expire_date'] = JalaliDate::get_date_in_jalali($service->expire_date);
            $service['categories'] = $service->categories;
        }
        $type = ServiceType::getServiceTypeWithKeyValue();
        $plan = ServicePlan::getServiceplanWithKeyValue();
        $oprators = $this->opratorRepository->all();
        $telecomcenters = $this->telecomcenterRepository->all();


        return ['services' => $services, 'type' => $type, 'plan' => $plan, 'oprators' => $oprators, 'telecomcentes' => $telecomcenters, 'categories' => $categories];
    }

    public function create(Request $request)
    {

        $serviceData = [
            'oprator_id' => $request->oprator_id,
            'name' => $request->name,
            'type' => $request->type,
            'plan' => $request->plan,
            'discount' => $request->discount,
            'period' => $request->period,
            'night_trafic' => $request->night_trafic,
            'speed' => $request->speed,
            'expire_date' => JalaliDate::convert_jalali_to_miladi($request->expire_date),
            'limit_amount' => $request->limit_amount,
            'international_trafic' => $request->international_trafic,
            'description' => $request->description,
            'telecomcenter_id' => $request->telecomcenter_id, //Sell_zone
            'commission_price' => $request->commission_price,
            'total_price' => $request->total_price,
            'sell_price' => $request->sell_price,
            'base_price' => $request->base_price,
            'available_id' => $request->available_id,
            'category_id' => $request->category_id,
            'price_id' => $request->price_id,
            'service_id' => $request->service_id,

        ];
        $service = $this->serviceRepository->create($serviceData);
        $category = $this->categoryRepository->find($request->category_id);
        $service->categories()->attach($category);
        $service->oprator;
        $service->telecomcenter;
        return $service;
    }

    public function delete(Request $request)
    {
        $serviceDeleted = $this->serviceRepository->delete($request->id);
        return $serviceDeleted;
    }

    public function edit(Request $request)
    {
        $service = $this->serviceRepository->find($request->id);
        $service['expire_date'] = JalaliDate::convert_miladi_to_jalali($service->expire_date);
        $service->oprator;
        return $service;
    }

    public function update(Request $request)
    {
        $serviceData = [
            'oprator_id' => $request->oprator_id,
            'name' => $request->name,
            'type' => $request->type,
            'plan' => $request->plan,
            'discount' => $request->discount,
            'period' => $request->period,
            'night_trafic' => $request->night_trafic,
            'speed' => $request->speed,
            'expire_date' => JalaliDate::convert_jalali_to_miladi($request->expire_date),
            'limit_amount' => $request->limit_amount,
            'international_trafic' => $request->international_trafic,
            'description' => $request->description,
            'commission_price' => $request->commission_price,
            'total_price' => $request->total_price,
            'sell_price' => $request->sell_price,
            'base_price' => $request->base_price,
            'available_id' => $request->available_id,
            'category_id' => $request->category_id,
            'price_id' => $request->price_id,
            'service_id' => $request->service_id,
            'telecomcenter_id' => $request->telecomcenter_id, //Sell_zone

        ];

        $service = $this->serviceRepository->find($request->id);
        $service->update($serviceData);
        $category = $this->categoryRepository->find($request->category_id);
        $service->categories()->sync($category);


        $service['expire_date'] = JalaliDate::convert_miladi_to_jalali($service->expire_date);
        $type = ServiceType::getServiceTypeWithTypeNumber($service->type);
        $plan = ServicePlan::getServicePlanWithPlanNumber($service->plan);
        $service->oprator;
        $service->telecomcenter;
        $service->categories;
        $service['type_name'] = $type;
        $service['plan_name'] = $plan;
        return $service;
    }
}
