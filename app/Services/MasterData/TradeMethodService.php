<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\TradeMethodRequest;
use App\Models\MasterTradeMethod;
use Exception;
use Illuminate\Http\Request;

class TradeMethodService
{
    public string $mainUrl;
    private MasterTradeMethod $tradeMethodEntity;

    public function __construct(
        MasterTradeMethod $tradeMethodEntity
    ) {
        $this->tradeMethodEntity = $tradeMethodEntity;

        $this->mainUrl = url('master-data/trade-method');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->tradeMethodEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data trade-method');
        $canDelete = auth()->user()->can('delete master-data trade-method');
        return datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => !$canEdit ? null : [
                            "url" => $this->mainUrl . '/edit/' . $row->id,
                        ],
                        "delete" => !$canDelete ? null : [
                            "url" => $this->mainUrl . '/delete/' . $row->id,
                        ],
                    ]
                ]);
            })
            ->make();
    }

    public function create(TradeMethodRequest $request)
    {
        $this->tradeMethodEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TradeMethodRequest $request, $id)
    {
        $tradeMethodEntity = $this->tradeMethodEntity->findOrFail($id);

        $tradeMethodEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $tradeMethodEntity = $this->tradeMethodEntity->findOrFail($id);
        try {
            $tradeMethodEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->tradeMethodEntity->all();
    }
}
