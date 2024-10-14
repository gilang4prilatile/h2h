<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Inbound;
use App\Models\Inventory;
use App\Models\InventoryConversion;
use App\Services\DashboardInboundService;
use App\Services\DashboardInventoryService;
use App\Services\DashboardOutboundService;
use DB;
use Illuminate\Contracts\Auth\Guard;
use Str;

class DashboardController extends MainController
{

    public DashboardInboundService $dashboardInboundService;
    public DashboardOutboundService $dashboardOutboundService;
    public DashboardInventoryService $dashboardInventoryService;

    private $rawDates = [
        1 => 'Jan',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Apr',
        5 => 'May',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Aug',
        9 => 'Sep',
        10 => 'Oct',
        11 => 'Nov',
        12 => 'Dec'
    ];

    public function __construct(
        Guard $auth,
        DashboardInboundService $dashboardInboundService,
        DashboardOutboundService $dashboardOutboundService,
        DashboardInventoryService $dashboardInventoryService
    ) {
        parent::__construct();
        $this->view = "dashboard.";
        $this->dashboardInboundService = $dashboardInboundService;
        $this->dashboardOutboundService = $dashboardOutboundService;
        $this->dashboardInventoryService = $dashboardInventoryService;
    }

    public function getIndex()
    {
        return redirect()->to('/dashboard/inbound');
    }

    public function getInbound()
    {


        $user = auth()->user();
        $inboundsClose  = $this->dashboardInboundService->getDataInboundByStatus('DONE');
        $inboundsOpen   = $this->dashboardInboundService->getDataInboundByStatus('DRAFT');

        return $this->makeView("inbound", [
            'moduleNav'     => 'dashboard',
            'user'          => $user,
            'inboundsClose' => $inboundsClose,
            'inboundsOpen'  => $inboundsOpen
        ]);
    }



    public function getDataInboundChartAjax($year)
    {

        $perMonthInbouneDone    = [];
        $perMonthInboundDraft   = [];

        $queryInboundDone = $this->dashboardInboundService->getDataInboundChart('DONE', $year);
        if (!empty($queryInboundDone))
            foreach ($queryInboundDone as $done) {
                foreach ($this->rawDates as $key => $date) {
                    if ($this->rawDates[$done->date] == $date) {
                        $perMonthInbouneDone[$key - 1] = $done->inbound;
                    } else {
                        $perMonthInbouneDone[$key - 1] = $perMonthInbouneDone[$key - 1] ?? 0;
                    }
                }
            }

        $queryInboundDraft = $this->dashboardInboundService->getDataInboundChart('DRAFT', $year);
        if (!empty($queryInboundDraft))
            foreach ($queryInboundDraft as $draft) {
                foreach ($this->rawDates as $key => $date) {
                    if ($this->rawDates[$draft->date] == $date) {
                        $perMonthInboundDraft[$key - 1] = $draft->inbound;
                    } else {
                        $perMonthInboundDraft[$key - 1] = $perMonthInboundDraft[$key - 1] ?? 0;
                    }
                }
            }

        return response()->json([
            'status'        => 'success',
            'perMonthInboundDone'  => $perMonthInbouneDone,
            'perMonthInboundDraft'  => $perMonthInboundDraft,
        ], 200);
    }

    public function getDataInboundQuantityChartAjax($year)
    {

        $perMonthBC40 = [];
        $perMonthBC23 = [];

        $queryInboundBC40 = $this->dashboardInboundService->getDataInboundQuantityChart('BC40', $year);
        if (!empty($queryInboundBC40))
            foreach ($queryInboundBC40 as $bc40) {
                foreach ($this->rawDates as $key => $date) {
                    if ($this->rawDates[$bc40->date] == $date) {
                        $perMonthBC40[$key - 1] = $bc40->inbound;
                    } else {
                        $perMonthBC40[$key - 1] = $perMonthBC40[$key - 1] ?? 0;
                    }
                }
            }

        $queryInboundBC23 = $this->dashboardInboundService->getDataInboundQuantityChart('BC23', $year);
        if (!empty($queryInboundBC23))
            foreach ($queryInboundBC23 as $bc23) {
                foreach ($this->rawDates as $key => $date) {
                    if ($this->rawDates[$bc23->date] == $date) {
                        $perMonthBC23[$key - 1] = $bc23->inbound;
                    } else {
                        $perMonthBC23[$key - 1] = $perMonthBC23[$key - 1] ?? 0;
                    }
                }
            }

        return response()->json([
            'status'        => 'success',
            'perMonthBC40'  => $perMonthBC40,
            'perMonthBC23'  => $perMonthBC23,
        ], 200);
    }

    public function getDataInboundTopGoodsChartAjax($year)
    {

        $perMonthDataGoods = [];

        foreach ($this->rawDates as $key => $date) {
            $queryDataGoods = $this->dashboardInboundService->getDataInboundTopGoodChart($key, $year);
            foreach ($queryDataGoods as $queryDataGood) {
                $quantityGoods = [];
                foreach ($this->rawDates as $ked => $rawDate) {
                    if ($key == $ked) {
                        $quantityGoods[$ked - 1] = floatval($queryDataGood->quantity_good);
                    } else {
                        $quantityGoods[$ked - 1] = $quantityGoods[$ked - 1] ?? 0;
                    }
                }

                $perMonthDataGoods[] = [
                    'name' => Str::limit($queryDataGood->name, 10),
                    'data' => $quantityGoods
                ];
            }
        }

        return response()->json([
            'status'            => 'success',
            'perMonthDataGoods' => $perMonthDataGoods
        ]);
    }

    //Dashboard Outbound Start

    public function getOutbound()
    {

        $user = auth()->user();
        $outboundsClose  = $this->dashboardOutboundService->getDataOutboundByStatus('DONE');
        $outboundsOpen   = $this->dashboardOutboundService->getDataOutboundByStatus('DRAFT');

        return $this->makeView("outbound", [
            'moduleNav'     => 'dashboard',
            'user'          => $user,
            'outboundsClose' => $outboundsClose,
            'outboundsOpen'  => $outboundsOpen
        ]);
    }

    public function getDataOutboundChartAjax($year)
    {

        $perMonthOutboundDone    = [];
        $perMonthOutboundDraft   = [];

        $queryOutboundDone = $this->dashboardOutboundService->getDataOutboundChart('DONE', $year);
        if (!empty($queryOutboundDone))
            foreach ($queryOutboundDone as $done) {
                foreach ($this->rawDates as $key => $date) {
                    if ($this->rawDates[$done->date] == $date) {
                        $perMonthOutboundDone[$key - 1] = $done->inbound;
                    } else {
                        $perMonthOutboundDone[$key - 1] = $perMonthOutboundDone[$key - 1] ?? 0;
                    }
                }
            }

        $queryOutboundDraft = $this->dashboardOutboundService->getDataOutboundChart('DRAFT', $year);
        if (!empty($queryOutboundDraft))
            foreach ($queryOutboundDraft as $draft) {
                foreach ($this->rawDates as $key => $date) {
                    if ($this->rawDates[$draft->date] == $date) {
                        $perMonthOutboundDraft[$key - 1] = $draft->inbound;
                    } else {
                        $perMonthOutboundDraft[$key - 1] = $perMonthOutboundDraft[$key - 1] ?? 0;
                    }
                }
            }

        return response()->json([
            'status'        => 'success',
            'perMonthOutboundDone'  => $perMonthOutboundDone,
            'perMonthOutboundDraft'  => $perMonthOutboundDraft,
        ], 200);
    }

    public function getDataOutboundQuantityChartAjax($year)
    {

        $perMonthBC41 = [];
        $perMonthBC25 = [];

        $queryOutboundBC41 = $this->dashboardOutboundService->getDataOutboundQuantityChart('BC41', $year);
        if (!empty($queryOutboundBC41))
            foreach ($queryOutboundBC41 as $bc41) {
                foreach ($this->rawDates as $key => $date) {
                    if ($this->rawDates[$bc41->date] == $date) {
                        $perMonthBC41[$key - 1] = $bc41->inbound;
                    } else {
                        $perMonthBC41[$key - 1] = $perMonthBC41[$key - 1] ?? 0;
                    }
                }
            }

        $queryOutboundBC25 = $this->dashboardOutboundService->getDataOutboundQuantityChart('BC25', $year);
        if (!empty($queryOutboundBC25))
            foreach ($queryOutboundBC25 as $bc25) {
                foreach ($this->rawDates as $key => $date) {
                    if ($this->rawDates[$bc25->date] == $date) {
                        $perMonthBC25[$key - 1] = $bc25->inbound;
                    } else {
                        $perMonthBC25[$key - 1] = $perMonthBC25[$key - 1] ?? 0;
                    }
                }
            }

        return response()->json([
            'status'        => 'success',
            'perMonthBC41'  => $perMonthBC41,
            'perMonthBC25'  => $perMonthBC25,
        ], 200);
    }

    public function getDataOutboundTopGoodsChartAjax($year)
    {

        $perMonthDataGoods = [];

        foreach ($this->rawDates as $key => $date) {
            $queryDataGoods = $this->dashboardOutboundService->getDataOutboundTopGoodChart($key, $year);
            foreach ($queryDataGoods as $queryDataGood) {
                $quantityGoods = [];
                foreach ($this->rawDates as $ked => $rawDate) {
                    if ($key == $ked) {
                        $quantityGoods[$ked - 1] = floatval($queryDataGood->quantity_good);
                    } else {
                        $quantityGoods[$ked - 1] = $quantityGoods[$ked - 1] ?? 0;
                    }
                }

                $perMonthDataGoods[] = [
                    'name' => Str::limit($queryDataGood->name, 16),
                    'data' => $quantityGoods
                ];
            }
        }

        return response()->json([
            'status'            => 'success',
            'perMonthDataGoods' => $perMonthDataGoods
        ]);
    }

    //Dashboard Inventory Start
    public function getInventory()
    {
        $queryInventories = new Inventory();

        $user = auth()->user();

        if (!$user->hasRole(['Super Admin'])) {
            $queryInventories = $queryInventories->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $totalGoodInventories = $this->getTotalGoodsInventory();

        $totalQuantityInventories = $queryInventories->sum('quantity');
        $totalOutboundInventories = $this->getTotalOutboundsInventory();

        $inventoryGoods = $this->getGoodsInventory();
        $inventoryConversionGoods = $this->getGoodsInventoryConversion();

        return $this->makeView("inventory", [
            'moduleNav'                 => 'dashboard',
            'user'                      => $user,
            'inventoryGoods'            => $inventoryGoods,
            'inventoryConversionGoods'  => $inventoryConversionGoods,
            'totalGoodInventories'      => $totalGoodInventories,
            'totalQuantityInventories'  => $totalQuantityInventories,
            'totalOutboundInventories'  => $totalOutboundInventories
        ]);
    }

    public function getGoodsInventory()
    {

        $queryInventories = new Inventory();

        $user = auth()->user();

        if (!$user->hasRole(['Super Admin'])) {
            $queryInventories = $queryInventories->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $inventoryGoods = $queryInventories->select('goods.*')->join('inbound_details', 'inventories.inbound_detail_id', '=', 'inbound_details.id')
            ->join('goods', 'inventories.good_id', '=', 'goods.id')
            ->groupBy('goods.id')
            ->get();

        return $inventoryGoods;
    }

    public function getGoodsInventoryConversion()
    {

        $queryInventoryConversions = new InventoryConversion();

        $user = auth()->user();

        if (!$user->hasRole(['Super Admin'])) {
            $queryInventoryConversions = $queryInventoryConversions->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryInventoryConversions = $queryInventoryConversions->select('goods.*')
            ->join('goods', 'inventory_conversions.good_id', '=', 'goods.id')
            ->get();

        return $queryInventoryConversions;
    }

    public function getTotalGoodsInventory()
    {

        $queryInventories = new Inventory();

        $user = auth()->user();

        if (!$user->hasRole(['Super Admin'])) {
            $queryInventories = $queryInventories->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }


        $totalGoodInventories = $queryInventories->select(DB::raw('COUNT(b.id) as count_goods'))
            ->join('inbound_details as a', 'inventories.inbound_detail_id', '=', 'a.id')
            ->join('goods as b', 'a.good_id', '=', 'b.id')
            ->groupBy('b.id')
            ->get()
            ->sum('count_goods');

        return $totalGoodInventories;
    }

    public function getTotalOutboundsInventory()
    {

        $queryInventories = new Inventory();

        $user = auth()->user();

        if (!$user->hasRole(['Super Admin'])) {
            $queryInventories = $queryInventories->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $totalOutboundInventories = $queryInventories->select(DB::raw('SUM(inventory_outbound_details.quantity_good_conversion) as count_outbounds'))
            ->join('inventory_outbound_details', 'inventory_outbound_details.inventory_id', '=', 'inventories.id')
            ->get()
            ->sum('count_outbounds');

        return $totalOutboundInventories;
    }

    public function getDataInventoryGoodsChartAjax($year, $goodID)
    {


        $perMonthDataInventories = [];

        foreach ($this->rawDates as $key => $date) {

            $inventoryGoods = $this->dashboardInventoryService->getDataInventoryGoods($key, $year, $goodID);
            foreach ($inventoryGoods as $inventoryGood) {
                $quantityStocks     = [];
                $quantityOutbounds  = [];
                $totalInventory = [];
                foreach ($this->rawDates as $ked => $rawDate) {
                    if ($key == $ked) {
                        $quantityStocks[$ked - 1] = floatval($inventoryGood->count_inventory);
                        $quantityOutbounds[$ked - 1] = floatval($inventoryGood->count_outbound);
                        $totalInventory[$ked - 1] = floatval($inventoryGood->total_inventory);
                    } else {
                        $quantityStocks[$ked - 1] = $quantityStocks[$ked - 1] ?? 0;
                        $quantityOutbounds[$ked - 1] = $quantityOutbounds[$ked - 1] ?? 0;
                        $totalInventory[$ked - 1] = $totalInventory[$ked - 1] ?? 0;
                    }
                }

                $perMonthDataInventories[0] = [
                    'name' => 'Stock',
                    'type' => 'column',
                    'data' => $totalInventory
                ];

                $perMonthDataInventories[1] = [
                    'name' => 'Sisah Stock',
                    'type' => 'column',
                    'data' => $quantityStocks
                ];


                $perMonthDataInventories[2] = [
                    'name' => 'Total Outbound',
                    'type' => 'line',
                    'data' => $quantityOutbounds
                ];
            }
        }

        return response()->json([
            'message' => 'success',
            'perMonthDataInventories' => $perMonthDataInventories
        ]);
    }


    public function getDataInventoryConversionGoodsChartAjax($year, $goodID)
    {

        $perMonthDataInventoryConversions = [];

        foreach ($this->rawDates as $key => $date) {

            $inventoryConversionGoods = $this->dashboardInventoryService->getDataInventoryConversionGoods($key, $year, $goodID);

            foreach ($inventoryConversionGoods as $inventoryConversionGood) {
                $quantityStocks     = [];
                $quantityOutbounds  = [];
                $totalInventory = [];
                foreach ($this->rawDates as $ked => $rawDate) {
                    if ($key == $ked) {
                        $quantityStocks[$ked - 1] = floatval($inventoryConversionGood->quantity);
                        $quantityOutbounds[$ked - 1] = floatval($inventoryConversionGood->total_outbound);
                        $totalInventory[$ked - 1] = floatval($inventoryConversionGood->total_quantity);
                    } else {
                        $quantityStocks[$ked - 1] = $quantityStocks[$ked - 1] ?? 0;
                        $quantityOutbounds[$ked - 1] = $quantityOutbounds[$ked - 1] ?? 0;
                        $totalInventory[$ked - 1] = $totalInventory[$ked - 1] ?? 0;
                    }
                }

                $perMonthDataInventoryConversions[0] = [
                    'name' => 'Stock',
                    'type' => 'column',
                    'data' => $totalInventory
                ];

                $perMonthDataInventoryConversions[1] = [
                    'name' => 'Sisah Stock',
                    'type' => 'column',
                    'data' => $quantityStocks
                ];


                $perMonthDataInventoryConversions[2] = [
                    'name' => 'Total Outbound',
                    'type' => 'line',
                    'data' => $quantityOutbounds
                ];
            }
        }

        return response()->json([
            'message' => 'success',
            'perMonthDataInventoryConversions' => $perMonthDataInventoryConversions
        ]);
    }
}
