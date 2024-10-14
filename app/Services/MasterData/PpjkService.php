<?php

namespace App\Services\MasterData;

use App\Models\MasterPpjk;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\PpjkRequest;
use App\Models\MasterIdentitas;

class PpjkService
{
    private MasterPpjk $ppjkEntity;
    private MasterIdentitas $identitas;
    public string $mainUrl;

    public function __construct(
        MasterPpjk $ppjkEntity,
        MasterIdentitas $identitas
    ) {
        $this->ppjkEntity = $ppjkEntity;
        $this->identitas = $identitas;

        $this->mainUrl = url('master-data/ppjk');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->ppjkEntity->select("id", "nama", "alamat", "no_ppjk");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        return datatables()->of($query)
            ->addColumn("actions", function ($row) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => [
                            "url" => $this->mainUrl . '/edit/' . $row->id,
                        ],
                        "delete" => [
                            "url" => $this->mainUrl . '/delete/' . $row->id,
                        ],
                    ]
                ]);
            })
            ->make();
    }

    public function createProperties()
    {
        $identitas = $this->identitas->getSelectBox();

        return [
            "identitas" => $identitas,
            "model" => $this->ppjkEntity,
            'moduleNav'=>'ppjk'
        ];
    }

    public function create(PpjkRequest $request)
    {
        $this->ppjkEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function editProperties($id)
    {
        $identitas = $this->identitas->getSelectBox();
        $entity = $this->ppjkEntity->findOrFail($id);
        return [
            "identitas" => $identitas,
            "model" => $entity,
            'moduleNav'=>'ppjk'
        ];
    }

    public function edit(PpjkRequest $request, $id)
    {
        $ppjkEntity = $this->ppjkEntity->findOrFail($id);

        $ppjkEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $ppjkEntity = $this->ppjkEntity->findOrFail($id);
        try {
            $ppjkEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
