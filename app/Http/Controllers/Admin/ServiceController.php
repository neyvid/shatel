<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\service\ServicePlan;
use App\Models\service\ServiceType;
use App\Repositories\OpratorRepository\OpratorRepository;
use App\Repositories\ServiceRepository\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepository;
    protected $opratorRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository();
        $this->opratorRepository = new OpratorRepository();
    }

    public function all()
    {
        $services = $this->serviceRepository->all('oprator');
        foreach ($services as $service) {
            $service['type'] = $service->type_name;
            $service['plan'] = $service->plan_name;
        }
        $type = ServiceType::getServiceTypeWithKeyValue();
        $plan = ServicePlan::getServiceplanWithKeyValue();
        $oprators=$this->opratorRepository->all();
        return ['services' => $services, 'type' => $type, 'plan' => $plan,'oprators'=>$oprators];
    }

    public function create(Request $request)
    {
        $serviceData = [
            'oprator_id' => $request->oprator_id,
            'name' => $request->name,
            'type' => $request->type,
            'plan' => $request->plan,
            'price' => $request->price,
            'discount' => $request->discount,
            'period' => $request->period,
            'night_trafic' => $request->night_trafic,
            'speed' => $request->speed,
            'limit_amount' => $request->limit_amount,
            'international_trafic' => $request->international_trafic,
            'description' => $request->description,
        ];
        $service = $this->serviceRepository->create($serviceData);
        $service->oprator;
        return $service;
    }

    public function delete(Request $request)
    {
        $serviceDeleted=$this->serviceRepository->delete($request->id);
        return $serviceDeleted;
    }

    public function edit(Request $request)
    {
        $service=$this->serviceRepository->find($request->id);
        $service->oprator;
        return $service;
    }

    public function update(Request $request)
    {
        $serviceData=[
            'oprator_id' => $request->oprator_id,
            'name' => $request->name,
            'type' => $request->type,
            'plan' => $request->plan,
            'price' => $request->price,
            'discount' => $request->discount,
            'period' => $request->period,
            'night_trafic' => $request->night_trafic,
            'speed' => $request->speed,
            'limit_amount' => $request->limit_amount,
            'international_trafic' => $request->international_trafic,
            'description' => $request->description,
        ];

        $service=$this->serviceRepository->find($request->id);
        $service->update($serviceData);
        $type = ServiceType::getServiceTypeWithTypeNumber($service->type);
        $plan = ServicePlan::getServicePlanWithPlanNumber($service->plan);
        $service->oprator;
        $service['type_name']=$type;
        $service['plan_name']=$plan;
        return $service;
    }
}
