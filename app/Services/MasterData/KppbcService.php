<?php

namespace App\Services\MasterData;

use App\Models\MasterKppbc;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\KppbcRequest;

class KppbcService
{
    private MasterKppbc $kppbcEntity;
    public string $mainUrl;

    public function __construct(
        MasterKppbc $kppbcEntity
    )
    {
        $this->kppbcEntity = $kppbcEntity;

        $this->mainUrl = url('master-data/kppbc');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->kppbcEntity->select("id", "code", "description");
//
//        $user = auth()->user();
//
//        if (!$user->hasRole(['Super Admin'])) {
//            $query = $query->whereHas('createdBy', function($query) use ($user) {
//                $query->where('warehouse_id', $user->warehouse_id);
//$query->where('profile_id', $user->profile_id);
//            });
//        }

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data kppbc');
        $canDelete = auth()->user()->can('delete master-data kppbc');
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

    public function create(KppbcRequest $request)
    {
        $this->kppbcEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(KppbcRequest $request, $id)
    {
        $kppbcEntity = $this->kppbcEntity->findOrFail($id);

        $kppbcEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $kppbcEntity = $this->kppbcEntity->findOrFail($id);
        try {
            $kppbcEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->kppbcEntity->all();
    }

    public function get($id) {
        return $this->kppbcEntity->find($id);
    }
}
