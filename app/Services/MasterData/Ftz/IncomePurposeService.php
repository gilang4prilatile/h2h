<?php

namespace App\Services\MasterData\Ftz;

use App\Http\Requests\MasterData\IncomePurposeRequest;
use App\Models\Ftz\MasterIncomePurpose;
use Exception;
use Illuminate\Http\Request;

class IncomePurposeService
{
    private MasterIncomePurpose $MasterIncomePurposeEntity;
    public string $mainUrl;

    public function __construct(
        MasterIncomePurpose $MasterIncomePurposeEntity
    ) {
        $this->MasterIncomePurposeEntity = $MasterIncomePurposeEntity;

        $this->mainUrl = url('master-data/ftz-income-purpose');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->MasterIncomePurposeEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data ftz-income-purpose');
        $canDelete = auth()->user()->can('delete master-data ftz-income-purpose');
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

    public function create(IncomePurposeRequest $request)
    {
        $this->MasterIncomePurposeEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(IncomePurposeRequest $request, $id)
    {
        $MasterIncomePurposeEntity = $this->MasterIncomePurposeEntity->findOrFail($id);

        $MasterIncomePurposeEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $MasterIncomePurposeEntity = $this->MasterIncomePurposeEntity->findOrFail($id);
        try {
            $MasterIncomePurposeEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->MasterIncomePurposeEntity->all();
    }
}
