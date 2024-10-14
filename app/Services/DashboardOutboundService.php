<?php

namespace App\Services;

use App\Models\Inbound;
use App\Models\Outbound;
use DB;
use Exception;
use Illuminate\Http\Request;

class DashboardOutboundService {
    private Outbound $model;
    
    public function __construct(Outbound $model) {
        $this->model = $model;
    }

    public function getDataOutboundByStatus($status)
    {
        $queryOutbounds = new Outbound();

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryOutbounds = $queryOutbounds->whereHas('createdBy', function($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $data = $queryOutbounds->join('statuses as b', 'outbounds.status_id', '=', 'b.id')
                ->where('b.name', $status)
                ->count();

        return $data;

    }

    public function getDataOutboundChart($status, $year)
    {

        $queryOutbounds = $this->model;

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryOutbounds = $queryOutbounds->whereHas('createdBy', function($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryOutbounds = $queryOutbounds->select(
                            DB::raw('COUNT(outbounds.id) as inbound'), 
                            DB::raw('MONTH(outbounds.created_at) as date')
                        )
                        ->join('bc_forms', 'outbounds.bc_form_id', '=', 'bc_forms.id')
                        ->join('statuses', 'outbounds.status_id', '=', 'statuses.id')
                        ->where('statuses.name', $status)
                        ->whereYear('outbounds.created_at', $year)
                        ->groupBy(DB::raw('MONTH(outbounds.created_at)'))
                        ->orderBy('outbounds.created_at')
                        ->get();

        return $queryOutbounds;

    }

    public function getDataOutboundQuantityChart($bc, $year)
    {

        $queryOutbounds = $this->model;

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryOutbounds = $queryOutbounds->whereHas('createdBy', function($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryOutbounds = $queryOutbounds->select(
                            DB::raw('COUNT(outbounds.id) as inbound'), 
                            DB::raw('MONTH(outbounds.created_at) as date')
                        )
                        ->join('bc_forms', 'outbounds.bc_form_id', '=', 'bc_forms.id')
                        ->join('statuses', 'outbounds.status_id', '=', 'statuses.id')
                        ->where('statuses.name', 'DONE')
                        ->where('bc_forms.name', $bc)
                        ->whereYear('outbounds.created_at', $year)
                        ->groupBy(DB::raw('MONTH(outbounds.created_at)'))
                        ->orderBy('outbounds.created_at')
                        ->get();

        return $queryOutbounds;
    }

    public function getDataOutboundTopGoodChart($month, $year)
    {

        $queryOutbounds = $this->model;

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryOutbounds = $queryOutbounds->whereHas('createdBy', function($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryOutbounds = $queryOutbounds->select(
                            'goods.*',
                            DB::raw('sum(outbound_details.quantity) as quantity_good')
                        )
                        ->join('bc_forms', 'outbounds.bc_form_id', '=', 'bc_forms.id')
                        ->join('statuses', 'outbounds.status_id', '=', 'statuses.id')
                        ->join('outbound_details', 'outbound_details.outbound_id', '=', 'outbounds.id')
                        ->join('goods', 'outbound_details.good_id', '=', 'goods.id')
                        ->where('statuses.name', 'DONE')
                        ->whereMonth('outbound_details.created_at', $month)
                        ->whereYear('outbound_details.created_at', $year)
                        ->groupBy('goods.id')
                        ->orderBy('quantity_good', 'DESC')
                        ->limit(10)->get();

        return $queryOutbounds;
    }

}