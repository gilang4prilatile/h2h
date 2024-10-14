<?php

namespace App\Services\MasterData;

use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\StatusRequest;

class StatusService
{
    private Status $statusEntity;
    public string $mainUrl;

    public function __construct(
        Status $statusEntity
    ) {
        $this->statusEntity = $statusEntity;

        $this->mainUrl = url('master-data/status');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->statusEntity->select("id", "code", "name");

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

    public function create(StatusRequest $request)
    {
        $this->statusEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(StatusRequest $request, $id)
    {
        $statusEntity = $this->statusEntity->findOrFail($id);

        $statusEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $statusEntity = $this->statusEntity->findOrFail($id);
        try {
            $statusEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
