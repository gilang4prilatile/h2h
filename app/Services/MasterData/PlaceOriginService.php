<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\PlaceOriginRequest;
use App\Models\MasterPlaceOfOrigin;
use Exception;
use Illuminate\Http\Request;

class PlaceOriginService
{
    private MasterPlaceOfOrigin $placeOriginEntity;
    public string $mainUrl;

    public function __construct(
        MasterPlaceOfOrigin $placeOriginEntity
    ) {
        $this->placeOriginEntity = $placeOriginEntity;

        $this->mainUrl = url('master-data/place-of-origin');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->placeOriginEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data place-of-origin');
        $canDelete = auth()->user()->can('delete master-data place-of-origin');
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

    public function create(PlaceOriginRequest $request)
    {
        $this->placeOriginEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(PlaceOriginRequest $request, $id)
    {
        $placeOriginEntity = $this->placeOriginEntity->findOrFail($id);

        $placeOriginEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $placeOriginEntity = $this->placeOriginEntity->findOrFail($id);
        try {
            $placeOriginEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->placeOriginEntity->all();
    }
}
