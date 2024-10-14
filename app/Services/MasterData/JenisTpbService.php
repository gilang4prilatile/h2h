<?php

namespace App\Services\MasterData;

use App\Models\MasterJenisTpb;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\JenisTpbRequest;

class JenisTpbService
{
    private MasterJenisTpb $jenisTpbEntity;
    public string $mainUrl;

    public function __construct(
        MasterJenisTpb $jenisTpbEntity
    ) {
        $this->jenisTpbEntity = $jenisTpbEntity;

        $this->mainUrl = url('master-data/jenis-tpb');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->jenisTpbEntity->select("id", "code", "name");

        // $user = auth()->user();

        // if (!$user->hasRole(['Super Admin'])) {
        //     $query->whereNull("warehouse_id")
        //         ->orWhere('warehouse_id', $user->warehouse_id);
        // }

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data jenis-tpb');
        $canDelete = auth()->user()->can('delete master-data jenis-tpb');
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

    public function create(JenisTpbRequest $request)
    {
        $this->jenisTpbEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(JenisTpbRequest $request, $id)
    {
        $jenisTpbEntity = $this->jenisTpbEntity->findOrFail($id);

        $jenisTpbEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $jenisTpbEntity = $this->jenisTpbEntity->findOrFail($id);
        try {
            $jenisTpbEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->jenisTpbEntity->all();
    }
}
