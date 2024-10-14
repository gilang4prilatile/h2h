<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\ExpenditureDestinationRequest;
use App\Models\MasterExpenditureDestination;
use App\Services\MasterData\ExpenditureDestinationService;
use Illuminate\Http\Request;

class ExpenditureDestinationController extends MasterDataController
{

    public MasterExpenditureDestination $expenditureDestinationEntity;
    public ExpenditureDestinationService $expenditureDestinationService;

    public function __construct(
        ExpenditureDestinationService $expenditureDestinationService,
        MasterExpenditureDestination $expenditureDestinationEntity
    ) {
        parent::__construct();

        $this->view .= "expenditure-destination.";
        $this->expenditureDestinationService = $expenditureDestinationService;
        $this->expenditureDestinationEntity = $expenditureDestinationEntity;
    }

    public function getData(Request $request)
    {
        return $this->expenditureDestinationService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'expendituredestination'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->expenditureDestinationEntity,
            'moduleNav'=>'expendituredestination'
        ]);
    }

    public function postCreate(ExpenditureDestinationRequest $request)
    {
        return $this->expenditureDestinationService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->expenditureDestinationEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'expendituredestintation'
        ]);
    }

    public function postEdit(ExpenditureDestinationRequest $request, $id)
    {
        return $this->expenditureDestinationService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->expenditureDestinationService->delete($id);
    }

}