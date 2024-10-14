<?php

namespace App\Services\MasterData\Ftz;

use App\Http\Requests\MasterData\ExpenditureGoalsRequest;
use App\Models\Ftz\MasterExpenditureGoals;
use Exception;
use Illuminate\Http\Request;

class ExpenditureGoalsService
{
    private MasterExpenditureGoals $MasterExpenditureGoalsEntity;
    public string $mainUrl;

    public function __construct(
        MasterExpenditureGoals $MasterExpenditureGoalsEntity
    ) {
        $this->MasterExpenditureGoalsEntity = $MasterExpenditureGoalsEntity;

        $this->mainUrl = url('master-data/ftz-expenditure-goals');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->MasterExpenditureGoalsEntity->select("id", "code_document" ,"code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data expenditure-goals');
        $canDelete = auth()->user()->can('delete master-data expenditure-goals');
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

    public function create(ExpenditureGoalsRequest $request)
    {
        $this->MasterExpenditureGoalsEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(ExpenditureGoalsRequest $request, $id)
    {
        $MasterExpenditureGoalsEntity = $this->MasterExpenditureGoalsEntity->findOrFail($id);

        $MasterExpenditureGoalsEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $MasterExpenditureGoalsEntity = $this->MasterExpenditureGoalsEntity->findOrFail($id);
        try {
            $MasterExpenditureGoalsEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->MasterExpenditureGoalsEntity->all();
    }
}
