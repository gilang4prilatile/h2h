<?php

namespace App\Services\MasterData;

use App\Models\MasterImportir;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\ImportirRequest;
use App\Models\MasterApi;
use App\Models\MasterIdentitas;

class ImportirService
{
    private MasterImportir $importirEntity;
    private MasterIdentitas $identitasEntity;
    private MasterApi $apiEntity;
    public string $mainUrl;

    public function __construct(
        MasterImportir $importirEntity,
        MasterIdentitas $identitasEntity,
        MasterApi $apiEntity
    ) {
        $this->importirEntity = $importirEntity;
        $this->identitasEntity = $identitasEntity;
        $this->apiEntity = $apiEntity;

        $this->mainUrl = url('master-data/importir');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->importirEntity->select("id", "nama", "alamat", "no_izin");

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
        $identitasEntity = $this->identitasEntity->getSelectBox();
        $api = $this->apiEntity->getSelectBox();

        return [
            "identitas" => $identitasEntity,
            "model" => $this->importirEntity,
            "api" => $api,
            'moduleNav'=>'importir'
        ];
    }

    public function create(ImportirRequest $request)
    {
        $this->importirEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function editProperties($id)
    {
        $identitasEntity = $this->identitasEntity->getSelectBox();
        $entity = $this->importirEntity->findOrFail($id);
        $api = $this->apiEntity->getSelectBox();
        return [
            "identitas" => $identitasEntity,
            "model" => $entity,
            "api" => $api,
            'moduleNav'=>'importir'
        ];
    }

    public function edit(ImportirRequest $request, $id)
    {
        $importirEntity = $this->importirEntity->findOrFail($id);

        $importirEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $importirEntity = $this->importirEntity->findOrFail($id);
        try {
            $importirEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
