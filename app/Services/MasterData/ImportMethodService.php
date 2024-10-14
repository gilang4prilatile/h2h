<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\ExportMethodRequest;
use App\Http\Requests\MasterData\ImportMethodRequest;
use App\Models\MasterImportType;
use Exception;
use Illuminate\Http\Request;

class ImportMethodService
{
    private MasterImportType $masterImportTypeEntity;
    public string $mainUrl;

    public function __construct(
        MasterImportType $masterImportTypeEntity
    ) {
        $this->masterImportTypeEntity = $masterImportTypeEntity;

        $this->mainUrl = url('master-data/import-method');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterImportTypeEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data import-method');
        $canDelete = auth()->user()->can('delete master-data import-method');
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

    public function create(ImportMethodRequest $request)
    {
        $this->masterImportTypeEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(ImportMethodRequest $request, $id)
    {
        $masterImportTypeEntity = $this->masterImportTypeEntity->findOrFail($id);

        $masterImportTypeEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterImportTypeEntity = $this->masterImportTypeEntity->findOrFail($id);
        try {
            $masterImportTypeEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterImportTypeEntity->all();
    }
}
