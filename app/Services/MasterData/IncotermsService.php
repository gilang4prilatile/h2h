<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\GoodCategoryRequest;
use App\Http\Requests\MasterData\IncotermsRequest;
use App\Models\InboundDetail;
use Exception;
use App\Models\MasterIncoterm;
use Illuminate\Http\Request;

class IncotermsService
{
    private MasterIncoterm $masterIncotermEntity;
    public string $mainUrl;

    public function __construct(
        MasterIncoterm $masterIncotermEntity
    ) {
        $this->masterIncotermEntity = $masterIncotermEntity;

        $this->mainUrl = url('master-data/incoterms');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterIncotermEntity->select("id","code", "description");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data incoterms');
        $canDelete = auth()->user()->can('delete master-data incoterms');
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

    public function create(IncotermsRequest $request)
    {
        $this->masterIncotermEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(IncotermsRequest $request, $id)
    {
        $masterIncotermEntity = $this->masterIncotermEntity->findOrFail($id);

        $masterIncotermEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterIncotermEntity = $this->masterIncotermEntity->findOrFail($id);

        $checkdetailinbound = InboundDetail::where('details->incoterm_id',$id)->exists();
        if ($checkdetailinbound == false) {
            $masterIncotermEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        }else{
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterIncotermEntity->all();
    }
}
