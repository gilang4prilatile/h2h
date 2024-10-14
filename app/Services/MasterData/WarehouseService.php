<?php

namespace App\Services\MasterData;

use App\Models\Warehouse;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\WarehouseRequest;

class WarehouseService
{
    private Warehouse $warehouseEntity;
    public string $mainUrl;

    public function __construct(
        Warehouse $warehouseEntity
    ) {
        $this->warehouseEntity = $warehouseEntity;

        $this->mainUrl = url('master-data/warehouse');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->warehouseEntity->select("id", "code", "name", "notifier", "position","division");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $user = auth()->user();
        $canEdit = $user->can('edit master-data warehouse');
        $canDelete = $user->can('delete master-data warehouse');
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

    public function create(WarehouseRequest $request)
    {
        $this->warehouseEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(WarehouseRequest $request, $id)
    {
        $warehouseEntity = $this->warehouseEntity->findOrFail($id);

        $warehouseEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $warehouseEntity = $this->warehouseEntity->findOrFail($id);
        try {
            $warehouseEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
