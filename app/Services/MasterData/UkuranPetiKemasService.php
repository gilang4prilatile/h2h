<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\UkuranPetiKemasRequest;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\ValasRequest;
use App\Models\Inbound;
use App\Models\MasterUkuranPetiKemas;
use App\Models\Outbound;

class UkuranPetiKemasService
{
    private MasterUkuranPetiKemas $ukuranPetiKemasEntity;
    public string $mainUrl;

    public function __construct(
        MasterUkuranPetiKemas $ukuranPetiKemasEntity
    ) {
        $this->ukuranPetiKemasEntity = $ukuranPetiKemasEntity;

        $this->mainUrl = url('master-data/ukuran-peti-kemas');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->ukuranPetiKemasEntity->select("id", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data ukuran-peti-kemas');
        $canDelete = auth()->user()->can('delete master-data ukuran-peti-kemas');
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
        $ukuranPetiKemasEntity = $this->ukuranPetiKemasEntity->findOrFail($id);
        return response()->json($ukuranPetiKemasEntity);
    }

    public function create(UkuranPetiKemasRequest $request)
    {
        $this->ukuranPetiKemasEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(UkuranPetiKemasRequest $request, $id)
    {
        $ukuranPetiKemasEntity = $this->ukuranPetiKemasEntity->findOrFail($id);

        $ukuranPetiKemasEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $ukuranPetiKemasEntity = $this->ukuranPetiKemasEntity->findOrFail($id);
        $checkdetailinbound  = Inbound::where('details->ukuran_peti_kemas_id',$ukuranPetiKemasEntity->id)->first();
        $checkdetailoutbound = Outbound::where('details->ukuran_peti_kemas_id',$ukuranPetiKemasEntity->id)->first();
        try {
            if($checkdetailinbound == null && $checkdetailoutbound == null){
                $ukuranPetiKemasEntity->delete();
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
