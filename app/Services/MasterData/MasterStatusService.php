<?php

namespace App\Services\MasterData;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\MasterStatusRequest;
use App\Models\MasterStatus;

class MasterStatusService
{
    private MasterStatus $masterStatusEntity;
    public string $mainUrl;

    public function __construct(
        MasterStatus $masterStatusEntity
    ) {
        $this->masterStatusEntity = $masterStatusEntity;

        $this->mainUrl = url('master-data/master-status');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterStatusEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data master-status');
        $canDelete = auth()->user()->can('delete master-data master-status');
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

    public function create(MasterStatusRequest $request)
    {
        $this->masterStatusEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(MasterStatusRequest $request, $id)
    {
        $masterStatusEntity = $this->masterStatusEntity->findOrFail($id);

        $masterStatusEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterStatusEntity = $this->masterStatusEntity->findOrFail($id);
        try {
            $masterStatusEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
