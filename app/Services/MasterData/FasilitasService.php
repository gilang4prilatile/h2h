<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\GoodCategoryRequest;
use App\Http\Requests\MasterData\FasilitasRequest;
use App\Models\InboundDetail;
use App\Models\MasterFasilitas;
use Exception;
use App\Models\MasterIncoterm;
use App\Models\OutboundDetail;
use Illuminate\Http\Request;

class FasilitasService
{
    private MasterFasilitas $masterFasilitasEntity;
    public string $mainUrl;

    public function __construct(
        MasterFasilitas $masterFasilitasEntity
    ) {
        $this->masterFasilitasEntity = $masterFasilitasEntity;

        $this->mainUrl = url('master-data/fasilitas');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterFasilitasEntity->select("id","code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data fasilitas');
        $canDelete = auth()->user()->can('delete master-data fasilitas');
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

    public function create(FasilitasRequest $request)
    {
        $this->masterFasilitasEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(FasilitasRequest $request, $id)
    {
        $masterFasilitasEntity = $this->masterFasilitasEntity->findOrFail($id);

        $masterFasilitasEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterFasilitasEntity = $this->masterFasilitasEntity->findOrFail($id);
        $checkdetailinbound  = InboundDetail::where('details->fasilitas',$masterFasilitasEntity->code)->first();
        $checkdetailoutbound = OutboundDetail::where('details->fasilitas',$masterFasilitasEntity->code)->first();
        
        try {
            if($checkdetailinbound == null && $checkdetailoutbound == null){
                $masterFasilitasEntity->delete();
                return redirect()->back()->with("success", "Data has been deleted");
            }
            else{
                return redirect()->back()->with("info", "Data cannot be deleted, because this data already used");
            }
        } catch (Exception $e) {
            return redirect()->back()->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterFasilitasEntity->all();
    }
}
