<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\SpecialSpecificationRequest;
use App\Models\MasterSpecialSpecification;
use Exception;
use Illuminate\Http\Request;

class SpecialSpecificationService
{
    private MasterSpecialSpecification $masterSpecialSpecificationEntity;
    public string $mainUrl;

    public function __construct(
        MasterSpecialSpecification $masterSpecialSpecificationEntity
    ) {
        $this->masterSpecialSpecificationEntity = $masterSpecialSpecificationEntity;

        $this->mainUrl = url('master-data/special-specification');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterSpecialSpecificationEntity->select("id", "code", "name", 'group');

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data special-specification');
        $canDelete = auth()->user()->can('delete master-data special-specification');
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

    public function create(SpecialSpecificationRequest $request)
    {
        $this->masterSpecialSpecificationEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(SpecialSpecificationRequest $request, $id)
    {
        $masterSpecialSpecificationEntity = $this->masterSpecialSpecificationEntity->findOrFail($id);

        $masterSpecialSpecificationEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterSpecialSpecificationEntity = $this->masterSpecialSpecificationEntity->findOrFail($id);
        try {
            $masterSpecialSpecificationEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterSpecialSpecificationEntity->all();
    }
}
