<?php

namespace App\Services\MasterData;

use App\Models\MasterPelabuhan;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\PelabuhanRequest;
use App\Models\Port;

class PelabuhanService
{
    private Port $pelabuhanEntity;
    public string $mainUrl;

    public function __construct(
        Port $pelabuhanEntity
    ) {
        $this->pelabuhanEntity = $pelabuhanEntity;

        $this->mainUrl = url('master-data/pelabuhan');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->pelabuhanEntity->select("id", "code", "name");

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

    public function create(PelabuhanRequest $request)
    {
        $this->pelabuhanEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(PelabuhanRequest $request, $id)
    {
        $pelabuhanEntity = $this->pelabuhanEntity->findOrFail($id);

        $pelabuhanEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $pelabuhanEntity = $this->pelabuhanEntity->findOrFail($id);
        try {
            $pelabuhanEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
