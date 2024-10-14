<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\ExpenditureDestinationRequest;
use App\Http\Requests\MasterData\OriginGoodRequest;
use App\Models\MasterExpenditureDestination;
use App\Models\MasterOriginOfGood;
use Exception;
use Illuminate\Http\Request;

class ExpenditureDestinationService
{
    private MasterExpenditureDestination $masterExpenditureDestinationEntity;
    public string $mainUrl;

    public function __construct(
        MasterExpenditureDestination $masterExpenditureDestinationEntity
    ) {
        $this->masterExpenditureDestinationEntity = $masterExpenditureDestinationEntity;

        $this->mainUrl = url('master-data/expenditure-destination');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterExpenditureDestinationEntity->select("id","code_document", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data expenditure-destination');
        $canDelete = auth()->user()->can('delete master-data expenditure-destination');
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

    public function create(ExpenditureDestinationRequest $request)
    {
        $this->masterExpenditureDestinationEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(ExpenditureDestinationRequest $request, $id)
    {
        $masterExpenditureDestinationEntity = $this->masterExpenditureDestinationEntity->findOrFail($id);

        $masterExpenditureDestinationEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterExpenditureDestinationEntity = $this->masterExpenditureDestinationEntity->findOrFail($id);
        try {
            $masterExpenditureDestinationEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterExpenditureDestinationEntity->all();
    }
}
