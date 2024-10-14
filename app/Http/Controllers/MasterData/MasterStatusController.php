<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\MasterStatusRequest;
use App\Http\Requests\MasterData\StatusRequest;
use App\Models\MasterStatus;
use App\Services\MasterData\MasterStatusService;
use App\Services\MasterData\StatusService;
use Illuminate\Http\Request;

class MasterStatusController extends MasterDataController
{
    public MasterStatus $masterStatus;
    public MasterStatusService $masterStatusService;

    public function __construct(
        MasterStatusService $masterStatusService,
        MasterStatus $masterStatus
    ) {
        parent::__construct();

        $this->view .= "master-status.";
        $this->masterStatusService = $masterStatusService;
        $this->masterStatus = $masterStatus;
    }

    public function getData(Request $request)
    {
        return $this->masterStatusService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'masterstatus'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->masterStatus,
            'moduleNav'=>'masterstatus'
        ]);
    }

    public function postCreate(MasterStatusRequest $request)
    {
        return $this->masterStatusService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->masterStatus->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'masterstatus'
        ]);
    }

    public function postEdit(MasterStatusRequest $request, $id)
    {
        return $this->masterStatusService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->masterStatusService->delete($id);
    }

}