<?php

namespace App\Services\MasterData;

use App\Models\MasterUom;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\UomRequest;

class UomService
{
    private MasterUom $uomEntity;
    public string $mainUrl;

    public function __construct(
        MasterUom $uomEntity
    )
    {
        $this->uomEntity = $uomEntity;

        $this->mainUrl = url('master-data/uom');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->uomEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data uom');
        $canDelete = auth()->user()->can('delete master-data uom');
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

    public function create(UomRequest $request)
    {
        $this->uomEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(UomRequest $request, $id)
    {
        $uomEntity = $this->uomEntity->findOrFail($id);

        $uomEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $uomEntity = $this->uomEntity->findOrFail($id);
        try {
            $uomEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
