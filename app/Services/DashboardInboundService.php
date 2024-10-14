<?php

namespace App\Services;

use App\Models\Inbound;
use DB;
use Exception;
use Illuminate\Http\Request;

class DashboardInboundService
{
    private Inbound $model;

    public function __construct(Inbound $model)
    {
        $this->model = $model;
    }

    public function getDataInboundByStatus($status)
    {
        $queryInbounds = new Inbound();

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryInbounds = $queryInbounds->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $data = $queryInbounds->join('statuses as b', 'inbounds.status_id', '=', 'b.id')
            ->where('b.name', $status)
            ->count();

        return $data;
    }

    public function getDataInboundChart($status, $year)
    {

        $queryInbounds = $this->model;

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryInbounds = $queryInbounds->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryInbounds = $queryInbounds->select(
            DB::raw('COUNT(inbounds.id) as inbound'),
            DB::raw('MONTH(inbounds.created_at) as date')
        )
            ->join('bc_forms', 'inbounds.bc_form_id', '=', 'bc_forms.id')
            ->join('statuses', 'inbounds.status_id', '=', 'statuses.id')
            ->where('statuses.name', $status)
            ->whereYear('inbounds.created_at', $year)
            ->groupBy(DB::raw('MONTH(inbounds.created_at)'))
            ->orderBy('inbounds.created_at')
            ->get();

        return $queryInbounds;
    }

    public function getDataInboundQuantityChart($bc, $year)
    {

        $queryInbounds = $this->model;

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryInbounds = $queryInbounds->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryInbounds = $queryInbounds->select(
            DB::raw('COUNT(inbounds.id) as inbound'),
            DB::raw('MONTH(inbounds.created_at) as date')
        )
            ->join('bc_forms', 'inbounds.bc_form_id', '=', 'bc_forms.id')
            ->join('statuses', 'inbounds.status_id', '=', 'statuses.id')
            ->where('statuses.name', 'DONE')
            ->where('bc_forms.name', $bc)
            ->whereYear('inbounds.created_at', $year)
            ->groupBy(DB::raw('MONTH(inbounds.created_at)'))
            ->orderBy('inbounds.created_at')
            ->get();

        return $queryInbounds;
    }

    public function getDataInboundTopGoodChart($month, $year)
    {

        $queryInbounds = $this->model;

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $queryInbounds = $queryInbounds->whereHas('createdBy', function ($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $queryInbounds = $queryInbounds->select(
            'goods.*',
            DB::raw('sum(inbound_details.quantity) as quantity_good')
        )
            ->join('bc_forms', 'inbounds.bc_form_id', '=', 'bc_forms.id')
            ->join('statuses', 'inbounds.status_id', '=', 'statuses.id')
            ->join('inbound_details', 'inbound_details.inbound_id', '=', 'inbounds.id') 
            ->join('goods', 'inbound_details.good_id', '=', 'goods.id')
            ->where('statuses.name', 'DONE')
            ->whereMonth('inbound_details.created_at', $month)
            ->whereYear('inbound_details.created_at', $year)
            ->groupBy('goods.id')
            ->orderBy('quantity_good', 'DESC')
            ->limit(10)->get();

        return $queryInbounds;
    }
}
