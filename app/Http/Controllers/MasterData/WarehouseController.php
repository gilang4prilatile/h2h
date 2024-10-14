<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Services\MasterData\WarehouseService;
use App\Http\Requests\MasterData\WarehouseRequest;
use App\Models\City;
use DB;

class WarehouseController extends MasterDataController
{
    public Warehouse $warehouseEntity;
    public WarehouseService $warehouseService;

    public function __construct(
        WarehouseService $warehouseService,
        Warehouse $warehouseEntity
    ) {
        parent::__construct();

        $this->view .= "warehouse.";
        $this->warehouseService = $warehouseService;
        $this->warehouseEntity = $warehouseEntity;
    }

    public function getData(Request $request)
    {
        return $this->warehouseService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'warehouse'));
    }

    public function getCreate()
    {
        
        $warehouses = null;
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $warehouses = Warehouse::where('id', $user->warehouse_id)->get();
        } else {
            $warehouses = Warehouse::all();
        }

        // $province = DB::table('cities')->select('province')->groupBy('province')->get();
        $city = City::all()->pluck('code_name','id');

        return $this->makeView("form", [
            "model" => $this->warehouseEntity,
            'moduleNav'=>'warehouse',
            'warehouses'=>$warehouses,
            'city' => $city
        ]);
    }

    public function postCreate(WarehouseRequest $request)
    {
        return $this->warehouseService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->warehouseEntity->findOrFail($id);
        $warehouses = null;
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $warehouses = Warehouse::where('id', $user->warehouse_id)->get();
        } else {
            $warehouses = Warehouse::all();
        }
        $city = City::all()->pluck('code_name','id');

        return $this->makeView("form", [
            "model" => $model,
            "warehouses" => $warehouses,
            'moduleNav'=>'warehouse',
            'city' => $city
        ]);
    }

    public function postEdit(WarehouseRequest $request, $id)
    {
        return $this->warehouseService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->warehouseService->delete($id);
    }
}
