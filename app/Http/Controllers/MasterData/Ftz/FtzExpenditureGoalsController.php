<?php

namespace App\Http\Controllers\MasterData\Ftz;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\ExpenditureGoalsRequest;
use App\Models\Ftz\MasterExpenditureGoals;
use App\Services\MasterData\Ftz\ExpenditureGoalsService;
use Illuminate\Http\Request;

class FtzExpenditureGoalsController extends MasterDataController
{
    public MasterExpenditureGoals $expenditureGoalsEntity;
    public ExpenditureGoalsService $expenditureGoalsService;

    public function __construct(
        ExpenditureGoalsService $expenditureGoalsService,
        MasterExpenditureGoals $expenditureGoalsEntity
    ) {
        parent::__construct();

        $this->view .= "ftz-expenditure-goals.";
        $this->expenditureGoalsService = $expenditureGoalsService;
        $this->expenditureGoalsEntity = $expenditureGoalsEntity;
    }

    public function getData(Request $request)
    {
        return $this->expenditureGoalsService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'expendituregoals'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->expenditureGoalsEntity,
            'moduleNav'=>'expendituregoals'
        ]);
    }

    public function postCreate(ExpenditureGoalsRequest $request)
    {
        return $this->expenditureGoalsService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->expenditureGoalsEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'expendituregoals'
        ]);
    }

    public function postEdit(ExpenditureGoalsRequest $request, $id)
    {
        return $this->expenditureGoalsService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->expenditureGoalsService->delete($id);
    }
}
