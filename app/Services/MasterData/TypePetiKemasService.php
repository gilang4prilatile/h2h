<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\TypePetiKemasRequest;
use App\Http\Requests\MasterData\UkuranPetiKemasRequest;
use App\Models\Inbound;
use Exception;
use Illuminate\Http\Request;
use App\Models\MasterTypePetiKemas;
use App\Models\MasterUkuranPetiKemas;
use App\Models\Outbound;

class TypePetiKemasService
{
    private MasterTypePetiKemas $typePetiKemasEntity;
    public string $mainUrl;

    public function __construct(
        MasterTypePetiKemas $typePetiKemasEntity
    ) {
        $this->typePetiKemasEntity = $typePetiKemasEntity;

        $this->mainUrl = url('master-data/type-peti-kemas');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->typePetiKemasEntity->select("id", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data type-peti-kemas');
        $canDelete = auth()->user()->can('delete master-data type-peti-kemas');
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
        $typePetiKemasEntity = $this->typePetiKemasEntity->findOrFail($id);
        return response()->json($typePetiKemasEntity);
    }

    public function create(TypePetiKemasRequest $request)
    {
        $this->typePetiKemasEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TypePetiKemasRequest $request, $id)
    {
        $typePetiKemasEntity = $this->typePetiKemasEntity->findOrFail($id);

        $typePetiKemasEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $typePetiKemasEntity = $this->typePetiKemasEntity->findOrFail($id);
        $checkdetailinbound  = Inbound::where('details->type_peti_kemas_id',$typePetiKemasEntity->id)->first();
        $checkdetailoutbound = Outbound::where('details->type_peti_kemas_id',$typePetiKemasEntity->id)->first();
        try {
            if($checkdetailinbound == null && $checkdetailoutbound == null){
                $typePetiKemasEntity->delete();
                return redirect($this->mainUrl)->with("success", "Data has been deleted");
            }
            else{
                return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
            }
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
