<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\ExportMethodRequest;
use App\Models\MasterExportMethod;
use Exception;
use Illuminate\Http\Request;

class ExportMethodService
{
    private MasterExportMethod $masterExportMethodEntity;
    public string $mainUrl;

    public function __construct(
        MasterExportMethod $masterExportMethodEntity
    ) {
        $this->masterExportMethodEntity = $masterExportMethodEntity;

        $this->mainUrl = url('master-data/export-method');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterExportMethodEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data export-method');
        $canDelete = auth()->user()->can('delete master-data export-method');
        return datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => !$canEdit ? null : [
                            "url" => $this->mainUrl . '/edit/' . $row->id
                        ],
                        "delete" => !$canDelete ? null : [
                            "url" => $this->mainUrl . '/delete/' . $row->id
                        ],
                    ]
                ]);
            })
            ->make();
    }

    public function create(ExportMethodRequest $request)
    {
        $this->masterExportMethodEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(ExportMethodRequest $request, $id)
    {
        $masterExportMethodEntity = $this->masterExportMethodEntity->findOrFail($id);

        $masterExportMethodEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterExportMethodEntity = $this->masterExportMethodEntity->findOrFail($id);
        try {
            $masterExportMethodEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterExportMethodEntity->all();
    }
}
