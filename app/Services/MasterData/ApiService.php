<?php

namespace App\Services\MasterData;

use App\Models\MasterApi;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\ApiRequest;

class ApiService
{
    private MasterApi $apiEntity;
    public string $mainUrl;

    public function __construct(
        MasterApi $apiEntity
    ) {
        $this->apiEntity = $apiEntity;

        $this->mainUrl = url('master-data/api');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->apiEntity->select("id", "code", "name");

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

    public function create(ApiRequest $request)
    {
        $this->apiEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(ApiRequest $request, $id)
    {
        $apiEntity = $this->apiEntity->findOrFail($id);

        $apiEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $apiEntity = $this->apiEntity->findOrFail($id);
        try {
            $apiEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
