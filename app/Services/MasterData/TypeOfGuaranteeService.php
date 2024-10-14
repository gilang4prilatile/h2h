<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\TypeOfGuaranteeRequest;
use Exception;
use App\Models\MasterTypeOfGuarantee;
use Illuminate\Http\Request;

class TypeOfGuaranteeService
{
    private MasterTypeOfGuarantee $masterTypeOfGuaranteeEntity;
    public string $mainUrl;

    public function __construct(
        MasterTypeOfGuarantee $masterTypeOfGuaranteeEntity
    ) {
        $this->masterTypeOfGuaranteeEntity = $masterTypeOfGuaranteeEntity;

        $this->mainUrl = url('master-data/type-of-guarantee');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterTypeOfGuaranteeEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data type-of-guarantee');
        $canDelete = auth()->user()->can('delete master-data type-of-guarantee');
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

    public function create(TypeOfGuaranteeRequest $request)
    {
        $this->masterTypeOfGuaranteeEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TypeOfGuaranteeRequest $request, $id)
    {
        $masterTypeOfGuaranteeEntity = $this->masterTypeOfGuaranteeEntity->findOrFail($id);

        $masterTypeOfGuaranteeEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterTypeOfGuaranteeEntity = $this->masterTypeOfGuaranteeEntity->findOrFail($id);
        try {
            $masterTypeOfGuaranteeEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterTypeOfGuaranteeEntity->all();
    }
}
