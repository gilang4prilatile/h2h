<?php

namespace App\Services\MasterData;

use App\Models\MasterIdentitas;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\IdentitasRequest;

class IdentitasService
{
    private MasterIdentitas $identitasEntity;
    public string $mainUrl;

    public function __construct(
        MasterIdentitas $identitasEntity
    ) {
        $this->identitasEntity = $identitasEntity;

        $this->mainUrl = url('master-data/identitas');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->identitasEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data identitas');
        $canDelete = auth()->user()->can('delete master-data identitas');
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

    public function create(IdentitasRequest $request)
    {
        $this->identitasEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(IdentitasRequest $request, $id)
    {
        $identitasEntity = $this->identitasEntity->findOrFail($id);

        $identitasEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $identitasEntity = $this->identitasEntity->findOrFail($id);
        try {
            $identitasEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
