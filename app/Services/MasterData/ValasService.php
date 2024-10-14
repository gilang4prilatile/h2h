<?php

namespace App\Services\MasterData;

use App\Models\MasterValas;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\ValasRequest;

class ValasService
{
    private MasterValas $valasEntity;
    public string $mainUrl;

    public function __construct(
        MasterValas $valasEntity
    ) {
        $this->valasEntity = $valasEntity;

        $this->mainUrl = url('master-data/valas');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->valasEntity->select("id", "code", "name", "nominal");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data valas');
        $canDelete = auth()->user()->can('delete master-data valas');
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

    public function getDetailJSON($id)
    {
        $valasEntity = $this->valasEntity->findOrFail($id);
        return response()->json($valasEntity);
    }

    public function create(ValasRequest $request)
    {
        $this->valasEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(ValasRequest $request, $id)
    {
        $valasEntity = $this->valasEntity->findOrFail($id);

        $valasEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $valasEntity = $this->valasEntity->findOrFail($id);
        try {
            $valasEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
