<?php

namespace App\Services\MasterData;
use App\Http\Requests\MasterData\ExportCategoryRequest;
use App\Models\MasterExportCategory;
use App\Models\MasterImportType;
use Exception;
use Illuminate\Http\Request;

class ExportCategoryService
{
    private MasterExportCategory $masterExportCategoryEntity;
    public string $mainUrl;

    public function __construct(
        MasterExportCategory $masterExportCategoryEntity
    ) {
        $this->masterExportCategoryEntity = $masterExportCategoryEntity;

        $this->mainUrl = url('master-data/export-category');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterExportCategoryEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data export-category');
        $canDelete = auth()->user()->can('delete master-data export-category');
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

    public function create(ExportCategoryRequest $request)
    {
        $this->masterExportCategoryEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(ExportCategoryRequest $request, $id)
    {
        $masterExportCategoryEntity = $this->masterExportCategoryEntity->findOrFail($id);

        $masterExportCategoryEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterExportCategoryEntity = $this->masterExportCategoryEntity->findOrFail($id);
        try {
            $masterExportCategoryEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterExportCategoryEntity->all();
    }
}
