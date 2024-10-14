<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\BankRequest;
use App\Models\Bank;
use App\Models\InboundTransportation;
use App\Models\Profile;
use Exception;
use Illuminate\Http\Request;

class BankService
{
    public string $mainUrl;
    private Bank $bankEntity;

    public function __construct(
        Bank $bankEntity
    ) {
        $this->bankEntity = $bankEntity;

        $this->mainUrl = url('master-data/bank');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->bankEntity->select("id", "no_seri", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data bank');
        $canDelete = auth()->user()->can('delete master-data bank');
        return datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => !$canEdit ? null : [
                            "url" => $this->mainUrl . '/edit/' . $row->id,
                        ],
                        "delete" => !$canDelete ? null : [
                            "url" => $this->mainUrl . '/delete/' . $row->id,
                        ],
                    ]
                ]);
            })
            ->make();
    }

    public function create(BankRequest $request)
    {
        $this->bankEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(BankRequest $request, $id)
    {
        $bankEntity = $this->bankEntity->findOrFail($id);

        $bankEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $bankEntity = $this->bankEntity->findOrFail($id);
        try {
            $bankEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->bankEntity->all();
    }
}
