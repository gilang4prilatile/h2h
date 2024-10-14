<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\OriginGoodRequest;
use App\Models\MasterOriginOfGood;
use Exception;
use Illuminate\Http\Request;

class OriginGoodService
{
    private MasterOriginOfGood $MasterOriginGoodEntity;
    public string $mainUrl;

    public function __construct(
        MasterOriginOfGood $MasterOriginGoodEntity
    ) {
        $this->MasterOriginGoodEntity = $MasterOriginGoodEntity;

        $this->mainUrl = url('master-data/origin-of-goods');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->MasterOriginGoodEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data origin-of-goods');
        $canDelete = auth()->user()->can('delete master-data origin-of-goods');
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

    public function create(OriginGoodRequest $request)
    {
        $this->MasterOriginGoodEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(OriginGoodRequest $request, $id)
    {
        $MasterOriginGoodEntity = $this->MasterOriginGoodEntity->findOrFail($id);

        $MasterOriginGoodEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $MasterOriginGoodEntity = $this->MasterOriginGoodEntity->findOrFail($id);
        try {
            $MasterOriginGoodEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->MasterOriginGoodEntity->all();
    }
}
