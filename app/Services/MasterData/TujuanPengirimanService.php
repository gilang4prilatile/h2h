<?php

namespace App\Services\MasterData;

use App\Models\MasterTujuanPengiriman;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\TujuanPengirimanRequest;

class TujuanPengirimanService
{
    private MasterTujuanPengiriman $tujuanPengirimanEntity;
    public string $mainUrl;

    public function __construct(
        MasterTujuanPengiriman $tujuanPengirimanEntity
    ) {
        $this->tujuanPengirimanEntity = $tujuanPengirimanEntity;

        $this->mainUrl = url('master-data/tujuan-pengiriman');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->tujuanPengirimanEntity->select("id", "code", "name", 'code_document');

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = $user->can('edit master-data tujuan-pengiriman');
        $canDelete = $user->can('delete master-data tujuan-pengiriman');
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

    public function create(TujuanPengirimanRequest $request)
    {
        $this->tujuanPengirimanEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TujuanPengirimanRequest $request, $id)
    {
        $tujuanPengirimanEntity = $this->tujuanPengirimanEntity->findOrFail($id);

        $tujuanPengirimanEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $tujuanPengirimanEntity = $this->tujuanPengirimanEntity->findOrFail($id);
        try {
            $tujuanPengirimanEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->tujuanPengirimanEntity->all();
    }
}
