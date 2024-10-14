<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\TypeGoodsRequest;
use Exception;
use App\Models\MasterTypeGoods;
use Illuminate\Http\Request;

class TypeGoodsService
{
    private MasterTypeGoods $masterTypeGoodsEntity;
    public string $mainUrl;

    public function __construct(
        MasterTypeGoods $masterTypeGoodsEntity
    ) {
        $this->masterTypeGoodsEntity = $masterTypeGoodsEntity;

        $this->mainUrl = url('master-data/type-goods');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterTypeGoodsEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data type-goods');
        $canDelete = auth()->user()->can('delete master-data type-goods');
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

    public function create(TypeGoodsRequest $request)
    {
        $this->masterTypeGoodsEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TypeGoodsRequest $request, $id)
    {
        $masterTypeGoodsEntity = $this->masterTypeGoodsEntity->findOrFail($id);

        $masterTypeGoodsEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterTypeGoodsEntity = $this->masterTypeGoodsEntity->findOrFail($id);
        try {
            $masterTypeGoodsEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterTypeGoodsEntity->all();
    }
}
