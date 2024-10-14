<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\GoodCategoryRequest;
use Exception;
use App\Models\MasterGoodCategory;
use Illuminate\Http\Request;

class GoodCategoryService
{
    private MasterGoodCategory $masterGoodCategoryEntity;
    public string $mainUrl;

    public function __construct(
        MasterGoodCategory $masterGoodCategoryEntity
    ) {
        $this->masterGoodCategoryEntity = $masterGoodCategoryEntity;

        $this->mainUrl = url('master-data/good-category');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterGoodCategoryEntity->select("id","code_document","code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data good-category');
        $canDelete = auth()->user()->can('delete master-data good-category');
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

    public function create(GoodCategoryRequest $request)
    {
        $this->masterGoodCategoryEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(GoodCategoryRequest $request, $id)
    {
        $masterGoodCategoryEntity = $this->masterGoodCategoryEntity->findOrFail($id);

        $masterGoodCategoryEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterGoodCategoryEntity = $this->masterGoodCategoryEntity->findOrFail($id);
        try {
            $masterGoodCategoryEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterGoodCategoryEntity->all();
    }
}
