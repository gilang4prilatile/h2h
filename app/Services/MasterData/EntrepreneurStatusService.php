<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\EntrepreneurStatusRequest;
use App\Models\MasterEntrepreneurStatus;
use Exception;
use Illuminate\Http\Request;

class EntrepreneurStatusService
{
    private MasterEntrepreneurStatus $masterEntrepreneurStatusEntity;
    public string $mainUrl;

    public function __construct(
        MasterEntrepreneurStatus $masterEntrepreneurStatusEntity
    ) {
        $this->masterEntrepreneurStatusEntity = $masterEntrepreneurStatusEntity;

        $this->mainUrl = url('master-data/entrepreneur-status');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterEntrepreneurStatusEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data entrepreneur-status');
        $canDelete = auth()->user()->can('delete master-data entrepreneur-status');
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

    public function create(EntrepreneurStatusRequest $request)
    {
        $this->masterEntrepreneurStatusEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(EntrepreneurStatusRequest $request, $id)
    {
        $masterEntrepreneurStatusEntity = $this->masterEntrepreneurStatusEntity->findOrFail($id);

        $masterEntrepreneurStatusEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterEntrepreneurStatusEntity = $this->masterEntrepreneurStatusEntity->findOrFail($id);
        try {
            $masterEntrepreneurStatusEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterEntrepreneurStatusEntity->all();
    }
}
