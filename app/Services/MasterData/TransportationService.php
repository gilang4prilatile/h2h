<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\TransportationRequest;
use App\Models\Transportation;
use Exception;
use Illuminate\Http\Request;

class TransportationService
{

    private Transportation $transportationEntity;
    public string $mainUrl;

    public function __construct(
        Transportation $transportationEntity
    ) {
        $this->transportationEntity = $transportationEntity;

        $this->mainUrl = url('master-data/transportations');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->transportationEntity->with(['transportLine:id,name'])->select("id", "code", "name", 'transport_line_id');

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data transportations');
        $canDelete = auth()->user()->can('delete master-data transportations');
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
            ->addColumn("transport_line", function($row){
                return $row->transportLine->name;
            })
            ->make();
    }

    public function create(TransportationRequest $request)
    {
        $this->transportationEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TransportationRequest $request, $id)
    {
        $transportationEntity = $this->transportationEntity->findOrFail($id);

        $transportationEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $transportationEntity = $this->transportationEntity->findOrFail($id);
        try {
            $transportationEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->transportationEntity->all();
    }
}