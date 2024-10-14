<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\InventoryConversion;
use App\Models\Outbound;
use DB;
use Exception;
use Illuminate\Http\Request;

class DashboardInventoryService
{
    private Inventory $model;
    private InventoryConversion $modelConversion;

    public function __construct(Inventory $model, InventoryConversion $modelConversion)
    {
        $this->model = $model;
        $this->modelConversion = $modelConversion;
    }

    public function getDataInventoryGoods($month, $year, $goodID)
    {

        $queryInventories = $this->model;

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryInventories = $queryInventories->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryInventories = $queryInventories->select(
            'goods.*',
            DB::raw('IFNULL(SUM(inventories.quantity), 0) as count_inventory'),
            DB::raw('IFNULL(SUM(inventory_outbound_details.quantity_good_conversion), 0) as count_outbound'),
            DB::raw('(IFNULL(SUM(inventories.quantity), 0) + IFNULL(SUM(inventory_outbound_details.quantity_good_conversion), 0)) total_inventory'),
            DB::raw('MONTH(inventories.created_at) as date')
        )
            ->leftJoin('inbound_details', 'inventories.inbound_detail_id', '=', 'inbound_details.id')
            ->leftJoin('goods', 'inventories.good_id', '=', 'goods.id')
            ->leftJoin('inventory_outbound_details', 'inventory_outbound_details.inventory_id', '=', 'inventories.id')
            ->whereYear('inventories.created_at', $year)
            ->whereMonth('inventories.created_at', $month)
            ->where('goods.id', $goodID)
            ->groupBy(DB::raw('MONTH(inventories.created_at)'))
            ->orderBy('inventories.created_at')
            ->get();

        return $queryInventories;
    }

    public function getDataInventoryConversionGoods($month, $year, $goodID)
    {

        $queryInventoryConverison = $this->modelConversion;

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryInventoryConverison = $queryInventoryConverison->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryInventoryConverison = $queryInventoryConverison->select(
            'goods.*',
            DB::raw('IFNULL( inventory_conversions.quantity , 0 ) as quantity'),
            DB::raw('IFNULL( inventory_conversions.total_outbound , 0 ) as total_outbound'),
            DB::raw('IFNULL( ( inventory_conversions.quantity + inventory_conversions.total_outbound ) , 0 ) as total_quantity'),
        )
            ->leftJoin('goods', 'inventory_conversions.good_id', '=', 'goods.id')
            ->whereYear('inventory_conversions.created_at', $year)
            ->whereMonth('inventory_conversions.created_at', $month)
            ->where('goods.id', $goodID)
            ->groupBy(DB::raw('MONTH(inventory_conversions.created_at)'))
            ->orderBy('inventory_conversions.created_at')
            ->get();

        return $queryInventoryConverison;
    }
}
