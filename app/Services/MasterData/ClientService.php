<?php

namespace App\Services\MasterData;

use App\Models\MasterClient;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\ClientRequest;

class ClientService
{
    private MasterClient $clientEntity;
    public string $mainUrl;

    public function __construct(
        MasterClient $clientEntity
    ) {
        $this->clientEntity = $clientEntity;

        $this->mainUrl = url('master-data/client');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);


        $query = $this->clientEntity->select("id", "name");

        $user = auth()->user();

        if (!$user->hasRole(['Super Admin'])) {
            $query->whereNull("warehouse_id")
                ->orWhere('warehouse_id', $user->warehouse_id);
        }

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

    public function create(ClientRequest $request)
    {
        $this->clientEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(ClientRequest $request, $id)
    {
        $clientEntity = $this->clientEntity->findOrFail($id);

        $clientEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $clientEntity = $this->clientEntity->findOrFail($id);
        try {
            $clientEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
