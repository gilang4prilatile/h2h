<?php

namespace App\Services\MasterData;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\TPSRequest;
use App\Models\MasterTPS;

class TPSService
{
    private MasterTPS $tpsEntity;
    public string $mainUrl;

    public function __construct(
        MasterTPS $tpsEntity
    ) {
        $this->tpsEntity = $tpsEntity;

        $this->mainUrl = url('master-data/tps');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->tpsEntity->select("id", "code_office", "code_warehouse", "name" , 'alamat');

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data tps');
        $canDelete = auth()->user()->can('delete master-data tps');
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
        $tpsEntity = $this->tpsEntity->findOrFail($id);
        return response()->json($tpsEntity);
    }

    public function create(TPSRequest $request)
    {
        $this->tpsEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TPSRequest $request, $id)
    {
        $tpsEntity = $this->tpsEntity->findOrFail($id);

        $tpsEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $tpsEntity = $this->tpsEntity->findOrFail($id);
        try {
            $tpsEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
