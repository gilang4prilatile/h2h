<?php

namespace App\Services\MasterData;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemService
{

    public function __construct(
        Item $itemEnitity
    ) {
        $this->itemEnitity = $itemEnitity;
        $this->mainUrl = url('master-data/item');
    }

    public function getDataPop40(Request $request)
    {
        $columns = ["items.id", "code", "hs", "uraian", "merk", "type"];
        $query = $this->itemEnitity
            ->select($columns)
            ->join("inbound_bc40_details", "inbound_bc40_details.item_id", "=", "items.id");

        $user = auth()->user();

        if (!$user->hasRole(['Super Admin'])) {
            $query->whereNull("warehouse_id")
                ->orWhere('warehouse_id', $user->warehouse_id);
        }

        if (!empty($request->search)) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $request->search . '%');
            }
        }

        return datatables()->of($query)
            ->addColumn("actions", function ($row) {
                return "<a href='javascript:void(0);' onclick=' return pilihBarang({$row->id})'>Pilih</a>";
            })
            ->rawColumns(['actions'])
            ->make();

    }
}
