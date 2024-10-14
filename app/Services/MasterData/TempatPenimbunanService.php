<?php

namespace App\Services\MasterData;

use App\Models\MasterTempatPenimbunan;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\TempatPenimbunanRequest;

class TempatPenimbunanService
{
    private MasterTempatPenimbunan $tempatPenimbunanEntity;
    public string $mainUrl;

    public function __construct(
        MasterTempatPenimbunan $tempatPenimbunanEntity
    ) {
        $this->tempatPenimbunanEntity = $tempatPenimbunanEntity;

        $this->mainUrl = url('master-data/tempatPenimbunan');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->tempatPenimbunanEntity->select("id", "code", "name");

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

    public function create(TempatPenimbunanRequest $request)
    {
        $this->tempatPenimbunanEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TempatPenimbunanRequest $request, $id)
    {
        $tempatPenimbunanEntity = $this->tempatPenimbunanEntity->findOrFail($id);

        $tempatPenimbunanEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $tempatPenimbunanEntity = $this->tempatPenimbunanEntity->findOrFail($id);
        try {
            $tempatPenimbunanEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
