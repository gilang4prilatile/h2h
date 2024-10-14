<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\TransportLineRequest;
use App\Models\TransportLine;
use Exception;
use Illuminate\Http\Request;

class TransportLineService
{
    private TransportLine $transportLineEntity;
    public string $mainUrl;

    public function __construct(
        TransportLine $transportLineEntity
    ) {
        $this->transportLineEntity = $transportLineEntity;

        $this->mainUrl = url('master-data/transport-line');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->transportLineEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data transport-line');
        $canDelete = auth()->user()->can('delete master-data transport-line');
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

    public function create(TransportLineRequest $request)
    {
        $this->transportLineEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TransportLineRequest $request, $id)
    {
        $transportLineEntity = $this->transportLineEntity->findOrFail($id);

        $transportLineEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $transportLineEntity = $this->transportLineEntity->findOrFail($id);
        try {
            $transportLineEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->transportLineEntity->all();
    }
}
